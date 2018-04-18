<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            return view('admin.dashboard');
        }

        $data['platforms'] = Platform::whereIsActive(true)->get();
        $data['subscription'] = Subscription::whereUserId(auth()->user()->id)->count();
        $data['investment'] = Investment::whereUserId(auth()->user()->id)->count();
        $data['referrals'] = Referral::whereUserId(auth()->user()->id)->count();

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
        return view('register');
    }
    
    public function ref($ref){
        $referral = User::whereSlug($ref)->first();
        if(!$referral){
            return redirect()->route('register');
        }
        return view('register',compact('referral'));
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
			'username'      => 'bail|required|string|max:100',
			'email'         => 'bail|required|string|email|max:255|unique:users',
			'telephone'     => 'bail|required|string|max:15',
			'country_id'    => 'bail|required|string',
			'state_id'    	=> 'bail|required|string',
			'password'      => 'bail|required|string|min:6|confirmed',
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
                // if(empty($referral)){
                //     $referral = 1;
                // }
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
}
