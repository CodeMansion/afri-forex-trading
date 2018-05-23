<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

use App\User;
use App\UserProfile;
use App\UserDownline;
use App\Mail\ConfirmRegistration;
use App\Mail\ForgetPassword;
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
use App\Notifications\NewMember;
use App\UserWallet;
use App\Withdrawal;

use Gate;
use Mail;
use DB;
use Validator;
use Carbon\Carbon;

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
            $data['withdrawal'] = Withdrawal::all()->count();

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
            $data['subscription'] = Subscription::userSubscriptions()->count();
            $data['userSub'] = Subscription::userSubscriptions()->first();
            $data['investment'] = Investment::whereUserId(auth()->user()->id)->count();
            $data['referrals'] = Referral::whereUserId(auth()->user()->id)->count();
            $data['activities'] = ActivityLog::userActivities()->orderBy('id','desc')->limit(5)->get();
            $data['transactions'] = PaymentTransaction::userTransactions()->orderBy('id','desc')->limit(5)->get();
            $data['supports'] = Dispute::userDispute()->orderBy('id','desc')->limit(5)->get();
            $data['earnings'] = User::find(auth()->user()->slug,'slug')->UserEarnings()->get();
            $data['balance'] = UserWallet::balance()->first()->amount;
            $data['debit'] = PaymentTransaction::userLatestDebit()->first();
            $data['credit'] = PaymentTransaction::userLatestCredit()->first();
            $data['withdrawal'] = Withdrawal::memberWithdrawal();
            $data['userplatforms'] = User::find(auth()->user()->id)->Platform()->get();

            return view('members.dashboard.index')->with($data);
        }
    }

    public function packageSubIndex()
    {
        $data['platforms'] = Platform::active()->get();
        $data['package_types'] = PackageType::all();
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

    public function getPackageTypes(Request $request)
    {
        try {
            $data = $request->except('_token');
            $param['package_types'] = PackageType::all();
            $param['package_id'] = $data['package_id'];

            return view('subscription.partials._get_package_types')->with($param);
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function getReferrerInfo(Request $request) {
        try {
            $data = $request->except('_token');
            $param['referrer'] = Platform::active()->where('id',$data['id'])->first();

            return view('subscription.partials._referrer_sub')->with($param);
        } catch(Exception $e) {
            return false;
        }
    }
    

    public function getInvestmentInfo(Request $request) {
        try {
            $data = $request->except('_token');
            $params['investment'] = Platform::active()->where('id',$data['id'])->first();
            $params['packages'] = Package::wherePlatformId($data['id'])->get();
            return view('subscription.partials._investment_sub')->with($params);
        } catch(Exception $e) {
            return false;
        }
    }

    public function getPackageType(Request $request) {
        try {
            $data = $request->except('_token');
            $params['package'] = Package::whereId($data['id'])->first();
            $params['package_types'] = PackageType::all();
            return view('subscription.partials._select_packages')->with($params);
        } catch(Exception $e) {
            return false;
        }
    }

    public function getInvestmentPaymentInfo(Request $request) {
        try {
            $data = $request->except('_token');
            $params['investment'] = Platform::active()->where('id',$data['platform_id'])->first();
            $params['package'] = Package::find($data['package_id']);
            $params['type'] = PackageType::find($data['package_type_id']);

            return view('subscription.partials._subscribe_investment')->with($params);
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
        $data['countries'] = Country::orderBy('name','ASC')->get();
        return view('register')->with($data);
    }
    
    public function ref($ref){
        $referral = User::whereSlug($ref)->first();
        $data['countries'] = Country::all();
        if(!$referral){
            return redirect()->route('register');
        }
        
        $data['referral'] = $referral;
        return view('register')->with($data);
    }

    public function forget_password(Request $request)
    {
        $user = User::whereEmail($request->email)->first();
        if(empty($user)){
            return response()->json(['type' => 'false','msg' => 'user with this email address does not exist!'], 200);
        }
        //\Mail::to($user)->send(new ForgetPassword($user));
        return response()->json(['type' => 'true','msg' => 'password reset link has beeen sent to your mail!'], 200);
    }
    
    public function reset($confirm)
    {
        return view('reset');
    }

    public function change_oldpassword(Request $request)
    {
        $user = User::whereId(auth()->user()->id)->first();
        if($user->password != bcrypt($request->old_password)){
            return $response = [
                'msg' => "your current password not correct.",
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
                
                Mail::to($user->email)->send(new ConfirmRegistration($user));
                
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

    public function activateAccount($slug, $check) {
        if(isset($slug) && $check == "true") {
            $member = User::find($slug,'slug');
            $is_active = $member->is_active;
            if($is_active) {
                \Session::flash("error","Has Account has already been activated. Please login");
                return redirect(url('/login'));
            } 

            $member->is_active = true;
            $member->save();

            \Session::flash("success","Your account has been activated successfully. Please login");
            return redirect(url('/login'));
        } else {
            return redirect(url('/404'));
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
        if(auth()->user()->is_admin) {
            $data['activities'] = ActivityLog::orderBy('id','DESC')->limit(10)->get();
        } elseif(auth()->user()->is_admin == 0) {
            $data['activities'] = ActivityLog::userActivities()->orderBy('id','DESC')->limit(10)->get();
        }
        
        return view('admin.partials.util._activity_logs')->with($data);
    }

    public function loadChart() {
        return true;
    }

    public function loadTransactions() {
        if(auth()->user()->is_admin) {
            $data['transactions'] = PaymentTransaction::orderBy('id','DESC')->limit(10)->get();
        } else if(auth()->user()->is_admin == 0) {
            $data['transactions'] = PaymentTransaction::userTransactions()->orderBy('id','DESC')->limit(10)->get();
        }
        
        return view('admin.partials.util._recent_transactions')->with($data);
    }

    public function loadEarnings() {
        if(auth()->user()->is_admin == 0) {
            $data['earnings'] = User::find(auth()->user()->slug, 'slug')->UserEarnings()->orderBy('id','DESC')->limit(10)->get();
        }
        
        return view('members.partials.util._latest_earnings')->with($data);
    }
}
