<?php

namespace App\Http\Controllers;

use App\Referral;
use Illuminate\Http\Request;
use App\Mail\Referrer;
use App\UserDownline;
use App\PaymentTransaction;
use App\UserWallet;
use Gate;

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

            $referral = Referral::whereUserId(auth()->user()->id)->first();
            $params['downlines'] = UserDownline::whereUplineId(auth()->user()->id)->wherePlatformId($referral->platform_id)->get();
            $params['transactions'] = PaymentTransaction::whereUserId(auth()->user()->id)->wherePlatformId($referral->platform_id)->get();
            $params['recent'] = PaymentTransaction::whereUserId(auth()->user()->id)->wherePlatformId($referral->platform_id)->orderBy('id','desc')->first();
            $params['wallet'] = UserWallet::whereUserId(auth()->user()->id)->first();
            $earning = \App\Earning::whereUserId(auth()->user()->id)->wherePlatformId($referral->platform_id)->first();
            
            if(!empty($earning)){
                $earning->amount = ($params['downlines']->count() - 2) * 5;
                $earning->save();
            }else{
                $earning                = new \App\Earning(); 
                $earning->slug           = bin2hex(random_bytes(64));
                $earning->user_id       = auth()->user()->id;
                $earning->platform_id   = $referral->platform_id;
                $earning->amount        = ($params['downlines']->count() - 2) * 5;
                $earning->save();
            }
            
            $params['earning'] = $earning;
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
                $referral                  = new Referral();
                $referral->slug            = bin2hex(random_bytes(64));
                $referral->user_id         = auth()->user()->id;
                $referral->platform_id     = $data['platform_id'];
                $referral->status          = 1;
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
                
                $wallet = UserWallet::insert([
                    'slug'          => bin2hex(random_bytes(64)),
                    'user_id'       => auth()->user()->id,
                    'amount'        => 0.00,
                    'status'        => 1,
                    'created_at'    => Carbon::now(),
                    'updated_at'    => Carbon::now()
                ]);
                
                
                //\Mail::to(auth()->user()->email)->send(new Referrer($referral));
                $ip = $_SERVER['REMOTE_ADDR'];
                activity_logs(auth()->user()->id, $ip, "Register For Referral");
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
