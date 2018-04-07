<?php

namespace App\Http\Controllers\Auth;



use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
	/*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
	use RegistersUsers;
	/**
     * Where to redirect users after registration.
     *
     * @var string
     */
	
	
	protected $redirectTo = '/home';
	
	/**
     * Create a new controller instance.
     *
     * @return void
     */
	public function __construct()
	{		
		$this->middleware('guest');		
	}
	/**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
	protected function validator(array $data)
	{		
		$custom_msg = [
			'ful_name'      => 'Fullname is Required',
			'username'      => 'Username is Required',
			'email'         => 'Email is Required',
			'telephone'     => 'Telephone Number is Required',
			'country_id'    => 'Country is Required',
			'state_id'    	=> 'State is Required',
			'password'      => 'Password & Confirm Password Don not Match',
		];
		
		
		return Validator::make($data, [
			'ful_name'      => 'bail|required|string|max:255',
			'username'      => 'bail|required|string|max:100',
			'email'         => 'required|string|email|max:255|unique:users',
			'telephone'     => 'required|string|telephone|max:15|unique:users',
			'country_id'    => 'required|string',
			'state_id'    	=> 'required|string',
			'password'      => 'required|string|min:6|confirmed',
		],$custom_msg);
		
	}
	
	
	
	
	
	/**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
	
	
	protected function create(array $data)
	{
		
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
		
		return $user;
		
		
	}
	
	
}


