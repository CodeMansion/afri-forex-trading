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

            $subscription = Subscription::UserSubscriptions()->first();
            $params['downlines'] = UserDownline::UserDownline()->wherePlatformId($subscription->platform_id)->get();
            $params['transactions'] = PaymentTransaction::UserTransactions()->wherePlatformId($subscription->platform_id)->get();
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

                $referral = Referral::UserReferrals()->count();
                $subscription = Subscription::UserSubscriptions()->count();
                if($referral > 0 ){
                    return $response = [
                        'msg' => "Sorry! You are not eligible for this service.",
                        'type' => "false"
                    ];
                }else if($subscription > 0){
                    return $response = [
                        'msg' => "You're already a member of this service",
                        'type' => "false"
                    ];
                }

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
        
    }

    public function Confirm_Payment(Request $request){
        $result = array();
        //The parameter after verify/ is the transaction reference to be verified
        $url = 'https://api.paystack.co/transaction/verify/'.$request->name;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt(
          $ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer SECRET_KEY']
        );
        $request = curl_exec($ch);
        if(curl_error($ch)){
         echo 'error:' . curl_error($ch);
         }
        curl_close($ch);

        if ($request) {
          $result = json_decode($request, true);
        }

        if (array_key_exists('data', $result) && array_key_exists('status', $result['data']) && ($result['data']['status'] === 'success')) {
          //echo "Transaction was successful";
          //return response()->json(['results' => $result ,'success' => 'Transaction was successful!'], 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
