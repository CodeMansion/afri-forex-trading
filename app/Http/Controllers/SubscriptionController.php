<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscription;
use DB;
use Carbon\Carbon;
use App\PaymentTransaction;
use App\Mail\Subscriptions;
use App\UserDownline;
use App\UserWallet;
use App\TransactionCategory;
use Gate;

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

            $subscription = Subscription::whereUserId(auth()->user()->id)->first();
            $params['downlines'] = UserDownline::whereUplineId(auth()->user()->id)->wherePlatformId($subscription->platform_id)->get();
            $params['transactions'] = PaymentTransaction::whereUserId(auth()->user()->id)->wherePlatformId($subscription->platform_id)->get();
            $params['recent'] = PaymentTransaction::whereUserId(auth()->user()->id)->wherePlatformId($subscription->platform_id)->orderBy('id','desc')->first();
            $params['wallet'] = UserWallet::whereUserId(auth()->user()->id)->first();
            $earning = \App\Earning::whereUserId(auth()->user()->id)->wherePlatformId($subscription->platform_id)->first();
            
            if(!empty($earning)){
                $earning->amount = $params['downlines']->count()  * 25;
                $earning->save();
            }else{
                $earning                = new \App\Earning();
                $earning->slug           = bin2hex(random_bytes(64));
                $earning->user_id       = auth()->user()->id;
                $earning->platform_id   = $subscription->platform_id;
                $earning->amount        = ($params['downlines']->count() - 2) * 5;
                $earning->save();
            }
            
            $params['earning'] = $earning;
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

                $wallet = UserWallet::insert([
                    'slug'          => bin2hex(random_bytes(64)),
                    'user_id'       => auth()->user()->id,
                    'amount'        => 0.00,
                    'status'        => 1,
                    'created_at'    => Carbon::now(),
                    'updated_at'    => Carbon::now()
                ]);

                $upline = UserDownline::whereDownlineId(auth()->user()->id)->first();
                if(isset($upline)){
                    if($upline->platform_id == Null){
                        $upline->platform_id = $subscribe->platform_id;
                        $upline->investment_amount= $transaction->amount;
                        $upline->is_active   = 1;
                        $upline->save();
                    }else{
                        // new platform downline
                        $downline               = new UserDownline();
                        $downline->platform_id  = $subscribe->platform_id;
                        $downline->upline_id 	= $upline->upline_id;
                        $downline->downline_id 	= $subscribe->user_id;
                        $downline->investment_amount= $transaction->amount;
                        $downline->is_active    = 1;
                        $downline->save();
                    }

                }

                //\Mail::to(auth()->user()->email)->send(new Subscriptions($subscribe));

                #TODO - Send system message

                activity_logs(auth()->user()->id, $_SERVER['REMOTE_ADDR'], "Subscribed for Daily Signal");
                return response()->json([
                    'msg' => "Payment successfull!"
                ],200);

            } catch(Exception $e) {
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
