<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserProfile;
use App\UserDownline;
use App\Mail\ConfirmRegistration;

class HomeController extends Controller
{
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->is_admin) {
            return view('admin.dashboard');
        }

        return view('members.dashboard');
    }


    public function registerIndex()
    {
        return view('register');
    }
    
    protected function validator(array $data)
	{		
		$custom_msg = [
			'user_id' 		=> 'Upline is Required',
			'ful_name'      => 'Fullname is Required',
			'username'      => 'Username is Required',
			'email'         => 'Email is Required',
			'telephone'     => 'Telephone Number is Required',
			'country_id'    => 'Country is Required',
			'state_id'    	=> 'State is Required',
			'password'      => 'Password & Confirm Password Don not Match',
		];
		
		
		return Validator::make($data, [
			'upline_id'		=> 'bail|required',
			'ful_name'      => 'bail|required|string|max:255',
			'username'      => 'bail|required|string|max:100',
			'email'         => 'bail|required|string|email|max:255|unique:users',
			'telephone'     => 'bail|required|string|telephone|max:15|unique:users',
			'country_id'    => 'bail|required|string',
			'state_id'    	=> 'bail|required|string',
			'password'      => 'bail|required|string|min:6|confirmed',
		],$custom_msg);
		
    }
    
    public function store()
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
                $user = User::create([
                    'slug'          => bin2hex(random_bytes(64)),
                    'full_name'     => $data['full_name'],
                    'username'      => $data['username'],  
                    'email'         => $data['email'],
                    'password'      => bcrypt($data['password']),
                ]);		
                
                $profile = UserProfile::create([
                    'user_id'       => $user->id,
                    'slug'          => bin2hex(random_bytes(64)),
                    'full_name'     => $data['full_name'], 
                    'email'         => $data['email'],
                    'telephone'     => $data['telephone'],
                    'country_id'    => $data['country_id'],
                    'state_id'      => $data['state_id'],
                ]);	
                
                $downline = UserDownline::create([
                    'upline_id' 	=> ($data['upline_id']) ? $data['upline_id'] : 1,
                    'downline_id' 	=> $user->id,
                ]);
                \Mail::to($user->email)->send(new ConfirmRegistration($user));
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
