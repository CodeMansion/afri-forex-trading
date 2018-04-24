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
use App\Country;
use Gate;
use Carbon\Carbon;
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
        if(auth()->user()->is_admin == 1) {
            $data['disputes'] = Dispute::orderBy('id','DESC')->limit(10)->get();
            $data['members'] = User::members()->orderBy('id','DESC')->limit(10)->get();
            $data['activities'] = ActivityLog::orderBy('id','DESC')->limit(10)->get();
            $data['transactions'] = PaymentTransaction::orderBy('id','DESC')->limit(10)->get();
            $data['transactions_count'] = PaymentTransaction::all()->count();
            $data['members_count'] = User::members()->count();

            return view('admin.dashboard.index')->with($data);
        }

        if(auth()->user()->is_admin == 0){
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

            $data['platforms'] = Platform::whereIsActive(true)->get();
            $data['subscription'] = Subscription::whereUserId(auth()->user()->id)->count();
            $data['investment'] = Investment::whereUserId(auth()->user()->id)->count();
            $data['referrals'] = Referral::whereUserId(auth()->user()->id)->count();
            $data['activities'] = ActivityLog::userActivities()->orderBy('id','desc')->limit(5)->get();
            $data['transactions'] = PaymentTransaction::userTransactions()->orderBy('id','desc')->limit(5)->get();
            $data['supports'] = Dispute::userDispute()->orderBy('id','desc')->limit(5)->get();

            return view('members.dashboard.index')->with($data);
        }
    }

    public function packageSubIndex()
    {
        $data['platforms'] = Platform::active()->get();
        
        return view('subscription.index')->with($data);
    }

    public function getDailySignalInfo(Request $request) {
        try {
            $data = $request->except('_token');
            $param['daily_signal'] = Platform::active()->where('id',$data['id'])->first();

            return view('subscription.partials._daily_signal_sub')->with($param);
        } catch(Exception $e) {
            return false;
        }
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
        $data['countries'] = Country::all();
        return view('register')->with($data);
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
			'password'      => 'Password & Confirm Password Don not Match',
		];
		
		return Validator::make($data, [
			'upline_id'		=> 'bail|required',
			'full_name'     => 'bail|required|string|max:255',
			'username'      => 'bail|required|string',
			'email'         => 'bail|required|string|email',
			'telephone'     => 'bail|required|string|max:15',
			'country_id'    => 'bail|required|string',
			'password'      => 'bail|required|string|min:6',
		],$custom_msg);
    }
    
    public function store(Request $request)
    {
        $data = $request->except('_except');
        if(isset($data) && $data['req'] == 'register_new_user') {
            $referral = User::whereUsername($data['upline_id'])->first()->id;
            \DB::beginTransaction();
            try {
                $validate = $this->validator($request->except('_token'));
                if($validate->fails()) {
                    return $response = [
                        'msg' => "Invalid Input",
                        'type' => 'false'
                    ];
                }

                $check_email = User::hasEmail($data['email']);
                if($check_email) {
                    return response()->json([
                        "msg"   => "This email already exist",
                        "type"  => "false"
                    ]);
                }

                $check_username = User::hasUsername($data['username']);
                if($check_username) {
                    return response()->json([
                        "msg"   => "This username already exist",
                        "type"  => "false"
                    ]);
                }

                $userId = User::insertGetId([
                    'slug'      => bin2hex(random_bytes(64)),
                    'full_name' => ucwords($data['full_name']),
                    'username'  => $data['username'],
                    'email'     => preg_replace('/\s/', '', strtolower($data['email'])),
                    'password'  => bcrypt($data['password']),
                    'is_admin'  => false,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
                
                $profile = new UserProfile();
                $profile->user_id = $userId;
                $profile->slug = bin2hex(random_bytes(64));
                $profile->full_name = $data['full_name'];
                $profile->email = $data['email'];
                $profile->telephone = $data['telephone'];
                $profile->country_id = $data['country_id'];
                $profile->save();
                
                $downline = new UserDownline();
                $downline->upline_id = ($referral) ? $referral : 1;
                $downline->downline_id = $userId;
                $downline->save();
                
                $user = User::find($userId);
                $user->assignRole(4);
                
                //\Mail::to($user->email)->send(new ConfirmRegistration($user));
                
                $admin = User::find(1);
                Notification::send($admin, new NewMember($profile));
                
                \DB::commit();
                return response()->json([
                    'msg'   => "Registration Successfull! A Confirmation Code Has Been Sent To Your Mail.",
                    'type'  => "true"
                ],200);

            } catch(Exception $e) {
                \DB::rollback();
                return redirect()->back()->with("error", $e->getMessage());
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

    public function loadActivityLogsOne() {
        $data['activities'] = ActivityLog::userActivities()->orderBy('id','DESC')->limit(10)->get();
        return view('admin.partials.util._activity_logs')->with($data);
    }

    public function loadChart() {
        return true;
    }

    public function loadTransactions() {
        $data['transactions'] = PaymentTransaction::orderBy('id','DESC')->limit(10)->get();
        return view('admin.partials.util._recent_transactions')->with($data);
    }

    public function loadTransactionsOne() {
        $data['transactions'] = PaymentTransaction::userTransactions()->orderBy('id','DESC')->limit(10)->get();
        return view('admin.partials.util._recent_transactions')->with($data);
    }
}
