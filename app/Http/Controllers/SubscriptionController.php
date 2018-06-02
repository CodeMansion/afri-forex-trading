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
use Gate;
use DB;
use Notification;
use App\User;
use App\Earning; 
use App\Package;
use App\PackageType;
use App\Platform;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    public function processPayment(Request $request,$type)
    {
        $data = $request->except('_token');
        if(isset($type) && $type == 'ajax') {
            \DB::beginTransaction();
            try {

                $subscribe = Subscription::insert([
                    'slug'          => bin2hex(random_bytes(64)),
                    'user_id'       => auth()->user()->id,
                    'platform_id'   => $data['id'],
                    'amount'        => (double)$data['amount'],
                    'is_first_time' => true,
                    'status'        => 1,
                    'expiry_date'   => Carbon::now()->addDays(60),
                    'created_at'    => Carbon::now(),
                    'updated_at'    => Carbon::now()
                ]);

                $transaction = PaymentTransaction::insert([
                    'slug'          => bin2hex(random_bytes(64)),
                    'user_id'       => auth()->user()->id,
                    'platform_id'   => $data['id'],
                    'transaction_category_id'   => TransactionCategory::where('name','Debit')->first()->id,
                    'amount'        => (double)$data['amount'],
                    'is_paid'       => true,
                    'reference_no'  => date('Ymdhis'),
                    'created_at'    => Carbon::now(),
                    'updated_at'    => Carbon::now()
                ]);

                $check_wallet = CheckMemberWallet(auth()->user()->id);
                if (!$check_wallet) {
                    $wallet = UserWallet::insert([
                        'slug'          => bin2hex(random_bytes(64)),
                        'user_id'       => auth()->user()->id,
                        'amount'        => 0.00,
                        'status'        => 1,
                        'created_at'    => Carbon::now(),
                        'updated_at'    => Carbon::now()
                    ]);
                }

                $upline = UserDownline::whereDownlineId(auth()->user()->id)->first();
                if(isset($upline)){
                    if($upline->platform_id == null){
                        $upline->platform_id = $data['id'];
                        $upline->investment_amount = (double)$data['amount'];
                        $upline->is_active = 1;
                        $upline->save();
                    }else{
                        $downline  = new UserDownline();
                        $downline->platform_id  = $data['id'];
                        $downline->upline_id = $upline->upline_id;
                        $downline->downline_id	= auth()->user()->id;
                        $downline->investment_amount = (double)$data['amount'];
                        $downline->is_active = 1;
                        $downline->save();
                    }
                }

                $admin = User::find(1);
                Notification::send($admin, new MemberSubscription($subscribe));

                //\Mail::to(auth()->user()->email)->send(new NewSubscription($data));
                \DB::commit();

                activity_logs(auth()->user()->id, $_SERVER['REMOTE_ADDR'], "Subscribed for Daily Signal");
                return response()->json([
                    'msg' => "Payment successfull!",
                    'type' => "true"
                ],200);

            } catch(Exception $e) {
                \DB::rollback();
                return false;
            }
        }

        if(isset($type) && $type == 'api') {

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
            $wallet_balance = UserWallet::balance()->first()->amount;
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
                    
                    $data['platform'] = Platform::find(1);
                    $data['balance'] = $wallet_balance;
                    $data['type'] = 1;

                    return view('subscription.payment')->with($data);
                }

                if($type->id == 2) {
                    $data['packages'] = Package::all();
                    $data['balance'] = $wallet_balance;

                    return view('subscription.view')->with($data);
                }

                if($type->id == 3) {
                    $referral = Referral::UserReferrals()->count();
                    if($referral > 0 ){
                        return redirect()->back()->with('error',"Sorry! You are not eligible for this service.");
                    } 


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
            if(Gate::allows('is_account_active')) {
                auth()->logout(); 
                \Session::flash('error', 'Your account is not activated! Please check your email and activate your account');
                return redirect('/login');
            }

            $data['platform'] = Platform::find($platform);
            $data['package_type'] = PackageType::find($type);
            $data['package'] = Package::find($package,'slug');
            $data['type'] = 2;

            return view('subscription.payment')->with($data);
        }
    }
}
