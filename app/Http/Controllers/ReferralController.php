<?php

namespace App\Http\Controllers;

use App\Referral;
use Illuminate\Http\Request;
use App\Mail\Referrer;
use App\UserDownline;
use App\PaymentTransaction;
use App\UserWallet;
use Carbon\Carbon;
use App\Investment;
use App\Subscription;
use App\Notifications\MemberSubscription;
use App\Mail\NewSubscription;
use Gate;
use Notification;

class ReferralController extends Controller
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

            $referral = Referral::UserReferrals()->first();
            $params['downlines'] = UserDownline::UserDownline()->wherePlatformId($referral->platform_id)->get();
            $params['transactions'] = PaymentTransaction::UserTransactions()->wherePlatformId($referral->platform_id)->get();
            
            return view('members.platforms.referrals.index')->with($params);
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

    protected function CheckIfOtherServicesExist(){
        $investment = Investment::UserInvestments()->count();
        $subscription = Subscription::UserSubscriptions()->count();
        if($investment > 0 || $subscription > 0){
            return $response = [
                'msg' => "Error.",
                'type' => "false"
            ];
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        if(isset($data) && $data['req'] == 'referral') {
            \DB::beginTransaction();
            try {

                $investment = Investment::UserInvestments()->count();
                $subscription = Subscription::UserSubscriptions()->count();
                if($investment > 0 || $subscription > 0){
                    return $response = [
                        'msg' => "Error.",
                        'type' => "false"
                    ];
                }

                $referral = new Referral();
                $referral->slug = bin2hex(random_bytes(64));
                $referral->user_id = auth()->user()->id;
                $referral->platform_id = $data['platform_id'];
                $referral->status = 1;
                $referral->save();  
                
                //Update Platform id in user downline                
                $upline = UserDownline::whereDownlineId(auth()->user()->id)->first();
                if(isset($upline)){
                    if($upline->platform_id == Null){
                        $upline->platform_id = $referral->platform_id;
                        $upline->is_active   = 1;
                        $upline->save();
                    }else{
                        // new platform downline
                        $downline               = new UserDownline();
                        $downline->platform_id  = $referral->platform_id;
                        $downline->upline_id 	= $upline->upline_id;
                        $downline->downline_id 	= $referral->user_id;
                        $downline->is_active    = 1;
                        $downline->save();
                    }

                }

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
                
                
                $admin = User::find(1);
                Notification::send($admin, new MemberSubscription($investment));

                \Mail::to(auth()->user()->email)->send(new NewSubscription($data));

                $ip = $_SERVER['REMOTE_ADDR'];
                activity_logs(auth()->user()->id, $ip, "Registered For Referral Service");
                
                \DB::commit();
                return $response = [
                    'msg' => "You Have Successfully Register For Referral.",
                    'type' => "true"
                ];

            } catch(Exception $e) {
                \DB::rollback();
                return $response = [
                    'msg' => "Internal Server Error",
                    'type' => "false"
                ];
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function show(Referral $referral)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function edit(Referral $referral)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Referral $referral)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function destroy(Referral $referral)
    {
        //
    }
}
