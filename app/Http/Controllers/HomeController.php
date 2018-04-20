<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

use App\User;
use App\UserProfile;
use App\UserDownline;
use App\Mail\ConfirmRegistration;
use DB;
use Validator;
use App\Platform;
use App\Package;
use App\PackageType;
use App\Subscription;
use App\Investment;
use App\Referral;
use App\Dispute;
use App\ActivityLog;
use App\PaymentTransaction;

use App\Notifications\NewMember;

class HomeController extends Controller
{
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data['menu_id'] = 1;

        if(\Auth::user()->is_admin == 1) {
            $data['disputes'] = Dispute::orderBy('id','DESC')->limit(10)->get();
            $data['members'] = User::members()->orderBy('id','DESC')->limit(10)->get();
            $data['activities'] = ActivityLog::orderBy('id','DESC')->limit(10)->get();
            $data['transactions'] = PaymentTransaction::orderBy('id','DESC')->limit(10)->get();
            $data['transactions_count'] = PaymentTransaction::all()->count();
            $data['members_count'] = User::members()->count();
            return view('admin.dashboard.index')->with($data);
        }

        $data['platforms'] = Platform::whereIsActive(true)->get();
        $data['subscription'] = Subscription::whereUserId(auth()->user()->id)->count();
        $data['investment'] = Investment::whereUserId(auth()->user()->id)->count();
        $data['referrals'] = Referral::whereUserId(auth()->user()->id)->count();
        $data['activities'] = ActivityLog::whereUserId(auth()->user()->id)->orderBy('id','desc')->limit(5)->get();
        $data['transactions'] = PaymentTransaction::whereUserId(auth()->user()->id)->orderBy('id','desc')->limit(5)->get();
        $data['supports'] = Dispute::whereUserId(auth()->user()->id)->orderBy('id','desc')->limit(5)->get();
        return view('members.dashboard')->with($data);
    }
    
    public function package(Request $request){        
        try {
            $params['packages'] = Package::wherePlatformId($request->platform_id)->get();
            if(($params['packages'])->count() > 0){
                $params['packagetypes'] = PackageType::all();
                return view('members.partials.package')->with($params);
            }
        } catch (Exception $e) {
            return false;
        }
    }


    public function registerIndex()
    {
        //$data['countries'] = Country::all();
        return view('register');
    }
    
    public function ref($ref){
        $referral = User::whereSlug($ref)->first();
        if(!$referral){
            return redirect()->route('register');
        }
        return view('register',compact('referral'));
    }

    public function forget_password(Request $request)
    {
        $user = User::whereEmail($request('email'))->first();
        if(!$user){
            return response()->json(['warning' => 'user with this email address does not exist!'], 200);
        }
        \Mail::to($user)->send(new Forget($user));
        return response()->json(['success' => 'password reset link has beeen sent to your mail!'], 200);
    }
    
    public function reset($confirm)
    {
        return view('reset');
    }

    public function check_oldpasword(Request $request)
    {
        $user = User::wherePassword($request->password)->first();
        if(!$user){
            return $response = [
                'msg' => "your password not correct.",
                'type' => "false"
            ];
        }
        return $response = [
            'type' => "true"
        ];
    }

    public function reset_confirm(Request $request,$confirm)
    {
        $user = User::whereSlug($confirm)->first();
        if(!$user){
            return $response = [
                'msg' => "your password reset link do not exist.",
                'type' => "false"
            ];
        }
        $user->is_active = 1;
        $user->password = $request->password;
        $user->save();
        return $response = [
            'msg' => "your password reset has been made successfully.",
            'type' => "true"
        ];
    }
    
    protected function validator(array $data)
	{		
		$custom_msg = [
			'user_id' 		=> 'Upline is Required',
			'full_name'     => 'Fullname is Required',
			'username'      => 'Username is Required',
			'email'         => 'Email is Required',
			'telephone'     => 'Telephone Number is Required',
			'country_id'    => 'Country is Required',
			'state_id'    	=> 'State is Required',
			'password'      => 'Password & Confirm Password Don not Match',
		];
		
		
		return Validator::make($data, [
			'upline_id'		=> 'bail|required',
			'full_name'     => 'bail|required|string|max:255',
			'username'      => 'bail|required|string|max:100|unique:users',
			'email'         => 'bail|required|string|email|max:255|unique:users',
			'telephone'     => 'bail|required|string|max:15',
			'country_id'    => 'bail|required|string',
			'state_id'    	=> 'bail|required|string',
			'password'      => 'bail|required|string|min:6',
		],$custom_msg);
		
    }
    
    public function store(Request $request)
    {
        $data = $request->except('_except');
        if(isset($data) && $data['req'] == 'register_new_user') {
            \DB::beginTransaction();
            try {
                $validate = $this->validator($request->except('_token'));
                if($validate->fails()) {
                    return $response = [
                        'msg' => $validate->errors(),
                        'type' => 'false'
                    ];
                }

                $referral = User::whereUsername($data['upline_id'])->first()->id;
                
                $user                   = new User();
                $user->slug             = bin2hex(random_bytes(64));
                $user->full_name        = $data['full_name'];
                $user->username         = $data['username'];
                $user->email            = $data['email'];
                $user->password         = bcrypt($data['password']);
                $user->save();
                
                $profile                = new UserProfile();
                $profile->user_id       = $user->id;
                $profile->slug          = bin2hex(random_bytes(64));
                $profile->full_name     = $data['full_name'];
                $profile->email         = $data['email'];
                $profile->telephone     = $data['telephone'];
                $profile->country_id    = $data['country_id'];
                $profile->state_id      = $data['state_id'];
                $profile->save();
                
                $downline               = new UserDownline();
                $downline->upline_id 	= ($referral) ? $referral : 1;
                $downline->downline_id 	= $user->id;
                $downline->save();

                $user->assignRole(4);
                
                //\Mail::to($user->email)->send(new ConfirmRegistration($user));
                
                $admin = User::find(1);
                Notification::send($admin, new NewMember($profile));

                $ip = $_SERVER['REMOTE_ADDR'];
                activity_logs($user->id, $ip, "User Registered");

                \DB::commit();
                return $response = [
                    'msg' => "Registration Successfull! A Confirmation Code Has Been Sent To Your Mail.",
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

    public function indexNotify(){
        return view('admin.partials.util._notification');
    }

    public function notifications() {
        return auth()->user()->unreadNotifications()->limit(5)->get()->toArray();
    }

    public function loadDispute(){
        $data['disputes'] = Dispute::all();
        return view('admin.partials.util._show_dispute')->with($data);
    }

    public function loadMembers() {
        $data['members'] = User::members()->orderBy('id','DESC')->limit(10)->get();
        return view('admin.partials.util._new_members')->with($data);
    }

    public function loadActivityLogs() {
        $data['activities'] = ActivityLog::orderBy('id','DESC')->limit(10)->get();
        return view('admin.partials.util._activity_logs')->with($data);
    }

    public function loadChart() {
        return true;
    }

    public function loadTransactions() {
        $data['transactions'] = PaymentTransaction::orderBy('id','DESC')->limit(10)->get();
        return view('admin.partials.util._recent_transactions')->with($data);
    }
}
