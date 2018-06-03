<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Subscription;
use Carbon\Carbon;
use App\PaymentTransaction;
use App\Mail\NewSubscription;
use App\UserDownline;
use App\Referral;
use App\UserWallet;
use App\TransactionCategory;
use App\Notifications\MemberSubscription;
use App\User;
use App\Earning; 
use App\Package;
use App\PackageType;
use App\Platform;
use App\Investment;
use App\Withdrawal;

use Gate;
use DB;
use Notification;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        if(auth()->user()->is_admin == 0) {
            if(Gate::allows('is_account_active')) {
                auth()->logout();	
                \Session::flash('error', 'Your account is not activated! Please check your email and activate your account');
                return redirect('/login');
            }
    
            $user = strtoupper(auth()->user()->full_name);
            if(!Gate::allows('has_member_paid')) {
                \Session::flash('error',"Sorry $user, you are required to subscribe for a platform before proceeding. Thank you!");
                return redirect(route('packageSub'));
            }

            $params['menu_id'] = 3.0;
            $subscription = Subscription::UserSubscriptions()->first();
            $params['downlines'] = User::find(auth()->user()->id)->UserDownlines($subscription->platform_id)->get();
            $params['transactions'] = PaymentTransaction::SubTransactions()->get();
            $params['earnings'] = Earning::SubscriptionEarnings()->get();

            return view('members.platforms.subscriptions.index')->with($params);
        }
    }


    public function processPayment(Request $request,$type)
    {
        $data = $request->except('_token');
        if(isset($type) && $type == 'ajax') {
            \DB::beginTransaction();
            try {

                if($data['platform'] == 1) {
                    $this->NewSubscription($data['amount']);
                } elseif($data['platform'] == 2) {
                    $this->NewInvestment($data['package_id'],$data['package_type_id']);
                } else{
                    $this->Referral();
                }

                $this->CreateNewPaymentTransaction($data['platform'],$data['amount']);
                $this->CreateNewWallet();
                $this->CreateDownline($data['platform'],$data['amount']);
                $this->SendNotification($data);

                //\Mail::to(auth()->user()->email)->send(new NewSubscription($data));
                \DB::commit();

                activity_logs(
                    auth()->user()->id, 
                    $_SERVER['REMOTE_ADDR'], 
                    "Dubscribe for a new investment"
                );

                return response()->json([
                    'msg' => "Payment successfull!",
                    'type' => "true"
                ],200);

            } catch(Exception $e) {
                \DB::rollback();
                return false;
            }
        }
    }

    
    public function PayWithWallet(Request $request)
    {
        $data = $request->except('_token');
        if($data) {
            \DB::beginTransaction();
            try {
                $member_wallet = UserWallet::balance()->first()->amount;
                $ledger_balance = $member_wallet - 10.00;
                $old_withdrawal = Withdrawal::where(['user_id'=>auth()->user()->id,'status'=>0])->first();

                if($old_withdrawal) {
                    return response()->json([
                        "msg"   => "You have a pending withdrawal request. Please try again after request has been attended to.",
                        "type"  => "false"
                    ]);
                }

                if($member_wallet < 10.00) {
                    return response()->json([
                        "msg"   => "Payment cannot be completed",
                        "head"  => "Insufficient Fund",
                        "type"  => "false"
                    ]);
                }

                if($ledger_balance >= (double)$data['amount']) {
                    
                    if($data['platform'] == 1) {
                        $this->NewSubscription($data['amount']);
                    } elseif($data['platform'] == 2) {
                        $this->NewInvestment($data['package_id'],$data['package_type_id']);
                    } else {
                        $this->NewReferral();
                    }

                    $this->DebitWallet($data['amount']);
                    $this->CreateNewPaymentTransaction($data['platform'],$data['amount']);
                    $this->CreateDownline($data['platform'],$data['amount']);
                    $this->SendNotification($data);

                    //\Mail::to(auth()->user()->email)->send(new NewSubscription($data));
                    \DB::commit();

                    activity_logs(
                        auth()->user()->id, 
                        $_SERVER['REMOTE_ADDR'], 
                        "Subscribed for Daily Signal"
                    );

                    return response()->json([
                        'msg' => "Payment successfull",
                        'type' => "true"
                    ],200);
                   
                } else {
                    return response()->json([
                        "head"  => "Payment Failed",
                        "msg"   => "You have insufficient fund.",
                        "type"  => "false"
                    ]);
                }
 
            } catch(Exception $e) {
                \DB::rollback();
            }
        }
    }


    protected function NewInvestment($package_id,$package_type_id)
    {
        $investment = Investment::insert([
            'slug'          => bin2hex(random_bytes(16)),
            'user_id'       => auth()->user()->id,
            'platform_id'   => 2,
            'package_id'    => $package_id,
            'package_type_id'   => $package_type_id,
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
    }


    protected function NewSubscription($amount)
    {
        $subscription = Subscription::UserSubscriptions()->count();
        $subscribe = Subscription::insert([
            'slug'          => bin2hex(random_bytes(16)),
            'user_id'       => auth()->user()->id,
            'platform_id'   => 1,
            'amount'        => (double)$amount,
            'is_first_time' => true,
            'status'        => 1,
            'expiry_date'   => ($subscription > 0) ? null : Carbon::now()->addDays(60),
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
    }

    protected function NewReferral()
    {
        $referral = Referral::insert([
            'slug'          => bin2hex(random_bytes(16)),
            'user_id'       => auth()->user()->id,
            'platform_id'   => 3,
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
    }

    protected function DebitWallet($amount)
    {
        if(isset($amount)) {
            $wallet = UserWallet::balance()->first();
            $wallet->amount -= (double)$amount;
            $wallet->save();
        }
    }


    protected function CreateNewWallet()
    {
        $check_wallet = CheckMemberWallet(auth()->user()->id);
        if (!$check_wallet) {
            $wallet = UserWallet::insert([
                'slug'          => bin2hex(random_bytes(16)),
                'user_id'       => auth()->user()->id,
                'amount'        => 0.00,
                'status'        => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ]);
        }
    }

    protected function CreateDownline($platform,$amount) 
    {
        $upline = UserDownline::whereDownlineId(auth()->user()->id)->first();
        if(isset($upline)){
            if($upline->platform_id == null){
                $upline->platform_id = $platform;
                $upline->investment_amount = (double)$amount;
                $upline->is_active = 1;
                $upline->save();
            }else{
                $downline  = new UserDownline();
                $downline->platform_id  = $platform;
                $downline->upline_id = $upline->upline_id;
                $downline->downline_id	= auth()->user()->id;
                $downline->investment_amount = (double)$amount;
                $downline->is_active = 1;
                $downline->save();
            }
        }
    }


    protected function CreateNewPaymentTransaction($platform,$amount)
    {
        if(isset($amount)) {
            $transaction = PaymentTransaction::insert([
                'slug'          => bin2hex(random_bytes(16)),
                'user_id'       => auth()->user()->id,
                'platform_id'   => $platform,
                'transaction_category_id'   => TransactionCategory::where('name','Debit')->first()->id,
                'amount'        => (double)$amount,
                'is_paid'       => true,
                'reference_no'  => date('Ymdhis'),
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ]);
        }
    }

    protected function SendNotification($data)
    {
        if($data){
            $admin = User::find(1);
            Notification::send($admin, new MemberSubscription($data));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(auth()->user()->is_admin == 0) {
            $wallet_balance = UserWallet::balance()->first();
            if(Gate::allows('is_account_active')) {
                auth()->logout(); 
                \Session::flash('error', 'Your account is not activated! Please check your email and activate your account');
                return redirect('/login');
            }

            if(isset($id)) {
                $type = Platform::find($id,'slug');
                if($type->id == 1) {
                    $subscription = Subscription::UserSubscriptions()->count();
                    if($subscription > 0){
                        return redirect()->back()->with('error',"You're already a member of this service");
                    }

                    $referral = Referral::UserReferrals()->count();
                    if($referral > 0 ){
                        return redirect()->back()->with('error',"Sorry! You are not eligible for this service.");
                    }
                    
                    $data['platform'] = Platform::find(1);
                    $data['balance'] = $wallet_balance;
                    $data['type'] = 1;

                    return view('subscription.payment')->with($data);
                }

                if($type->id == 2) {
                    $referral = Referral::UserReferrals()->count();
                    if($referral > 0 ){
                        return redirect()->back()->with('error',"Sorry! You are not eligible for this service.");
                    }

                    $data['packages'] = Package::all();
                    $data['balance'] = $wallet_balance;

                    return view('subscription.view')->with($data);
                }

                if($type->id == 3) {
                    $subscription = Subscription::UserSubscriptions()->count();
                    if($subscription > 0){
                        return redirect()->back()->with('error',"You're already a member of this service");
                    }

                    $investment = Investment::UserInvestments()->count();
                    if($investment > 0){
                        return redirect()->back()->with('error',"You're not eligible for this service");
                    }

                    $referral = Referral::UserReferrals()->count();
                    if($referral > 0 ){
                        return redirect()->back()->with('error',"Sorry! You are already a member this service.");
                    }

                    $data['platform'] = Platform::find(3);
                    $data['balance'] = $wallet_balance;
                    $data['type'] = 1;

                    return view('subscription.payment')->with($data);
                }
            }
        }
    }


    public function showPackageTypes($id)
    {
        if(auth()->user()->is_admin == 0) {
            if(Gate::allows('is_account_active')) {
                auth()->logout(); 
                \Session::flash('error', 'Your account is not activated! Please check your email and activate your account');
                return redirect('/login');
            }

            if(isset($id)) {
                $data['package'] = Package::find($id,'slug');
                $data['types'] = PackageType::all();

                return view('subscription.view_types')->with($data);
            }
        }
    }


    public function ViewPayment($package,$type,$platform)
    {
        if(auth()->user()->is_admin == 0) {
            $wallet_balance = UserWallet::balance()->first();
            if(Gate::allows('is_account_active')) {
                auth()->logout(); 
                \Session::flash('error', 'Your account is not activated! Please check your email and activate your account');
                return redirect('/login');
            }

            $referral = Referral::UserReferrals()->count();
            if($referral > 0 ){
                return redirect()->back()->with('error',"Sorry! You are not eligible for this service.");
            } 

            $data['platform'] = Platform::find($platform);
            $data['package_type'] = PackageType::find($type);
            $data['package'] = Package::find($package,'slug');
            $data['balance'] = $wallet_balance;
            $data['type'] = 2;

            return view('subscription.payment')->with($data);
        }
    }
}
