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
use App\UserAccount;

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
            $data['withdrawals'] = Withdrawal::orderBy('id','DESC')->get();

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
            $data['withdrawal'] = Withdrawal::memberWithdrawal()->first();
            $data['withdrawals'] = Withdrawal::memberWithdrawal()->get();
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
        $referral = User::whereUsername($ref)->first();
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
            return response()->json([
                'type' => 'false',
                'msg' => 'user with this email address does not exist!'
            ]);
        }

        if($user) {
            $new_password = $this->NewPassword();
            $user->password = $new_password;
            $user->save();

            $param['new_password'] = $new_password;
            $param['email'] = $user->email;

            $this->SendEmail($param);

            return response()->json([
                'type' => 'true',
                'msg' => 'Your new password has been sent to your email successfully.'
            ], 200);

        } else {
            return response()->json([
                'type' => 'false',
                'msg' => 'Invalid email address'
            ]);
        }
    }

    protected function SendEmail($param) {
        if($param) {
            Mail::to($param['email'])->send(new ForgetPassword($param));
        }
    }

    protected function NewPassword() {
        $new_password = str_random(15);
        return $new_password;
    }
    
   
    public function change_oldpassword(Request $request)
    {
        try {
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
        } catch (\Exception $e) {
            return response()->json([
                "msg"   => $e->getMessage(),
                "type"  => "false",
                "head"  => "Please try again"
            ]);
        }
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
                    'slug'      => bin2hex(random_bytes(16)),
                    'full_name' => ucwords($data['full_name']),
                    'username'  => $data['username'],
                    'email'     => preg_replace('/\s/', '', strtolower($data['email'])),
                    'password'  => bcrypt($data['password']),
                    'is_admin'  => false,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                $account = UserAccount::insertGetId([
                    'user_id'   => $userId,
                    'slug'      => bin2hex(random_bytes(16))
                ]);
                
                $profile = new UserProfile();
                $profile->user_id = $userId;
                $profile->slug = bin2hex(random_bytes(16));
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
                $user->assignRole(5);
                
                Mail::to($user->email)->send(new ConfirmRegistration($user));
                
                $admin = User::find(1);
                Notification::send($admin, new NewMember($profile));
                
                \DB::commit();
                return response()->json([
                    'msg'   => "Registration Successfull! A Confirmation Code Has Been Sent To Your Mail.",
                    'type'  => "true"
                ],200);

            } catch(\Exception $e) {
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

            $this->CreateNewWallet($member->id);

            \Session::flash("success","Your account has been activated successfully. Please login");
            return redirect(url('/login'));
        } else {
            return redirect(url('/404'));
        }
    }


    protected function CreateNewWallet($id)
    {
        if ($id) {
            $wallet = UserWallet::insert([
                'slug'          => bin2hex(random_bytes(16)),
                'user_id'       => $id,
                'amount'        => 0.00,
                'status'        => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ]);
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

    public function loadWithdrawals() {
        if(auth()->user()->is_admin == 1) {
            $data['withdrawals'] = Withdrawal::orderBy('id','DESC')->get();
        } elseif(auth()->user()->is_admin == 0) {
            $data['withdrawals'] = Withdrawal::memberWithdrawal()->get();
        }
        return view('members.partials.util._latest_withdrawals')->with($data);
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
            return view('members.partials.util._latest_earnings')->with($data);
        }
    }


    public function MarkNotification($id, $type) {
        switch ($type) {
            case 'new-dispute':
                $this->mark_as_read($id);
                return redirect(url('/disputes'));
                break;

            case 'earnings':
                $this->mark_as_read($id);
                return redirect(url('/earnings'));

            case 'subscription':
                $this->mark_as_read($id);
                return redirect(url('/transactions'));

            case 'new-member':
                $this->mark_as_read($id);
                return redirect(url('/members'));

            case 'new-testimony':
                $this->mark_as_read($id);
                return redirect(url('/testimonies'));

            case 'reply-dispute':
                $this->mark_as_read($id);
                return redirect(url('/disputes'));

            case 'withdrawal':
                $this->mark_as_read($id);
                return redirect(url('/withdrawals'));

            case 'unsubscribe':
                $this->mark_as_read($id);
                return redirect(url('/transactions'));

            case 'approve-withdrawal':
                $this->mark_as_read($id);
                return redirect(url('/withdrawals'));

            case 'decline-withdrawal':
                $this->mark_as_read($id);
                return redirect(url('/withdrawals'));

            case 'complete-withdrawal':
                $this->mark_as_read($id);
                return redirect(url('/withdrawals'));

            case 'referral-earnings':
                $this->mark_as_read($id);
                return redirect(url('/earnings'));

            case 'monthly-charge':
                $this->mark_as_read($id);
                return redirect(url('/transactions'));
            
            default:
                return redirect(url('/404'));
                break;
        }
    }

    protected function mark_as_read($id) {
        $notification = \DB::table('notifications')->where('id',$id)
        ->update([
            'read_at' => Carbon::now(),
        ]);
    }
}
