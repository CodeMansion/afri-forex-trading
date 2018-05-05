<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserProfile;
use App\UserWallet;
use Gate;
use App\PaymentTransaction;
use App\TransactionCategory;
use App\ActivityLog;
use Validator;

class UserController extends Controller
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

            $data['menu_id'] = 2;
            $data['profile'] = User::userProfile();
            $data['activities'] = ActivityLog::userActivities()->orderBy('id','desc')->get();

            return view('members.profile.index')->with($data);
        }
            
        if(\Auth::user()->is_admin) {
            $data['menu_id'] = 5;
            $data['members'] = User::all()->except(1);

            return view('admin.members.index')->with($data);
        }
    }

    public function getEditInfo(Request $request)
    {
        try {
            $params['packagetype'] = User::find($request->user_id, 'slug');
            return view('admin.users.partials._users_details_')->with($params);
        } catch (Exception $e) {
            return false;
        }
    }

    public function getUserDetails(Request $request)
    {
        try {
            $params['detail'] = User::where('username',$request->detail)->orwhere('email',$request->detail)->first();
            if($params['detail']){
                return view('members.profile.modals._user_detail_')->with($params);
            } 
            return "false";          
        } catch (Exception $e) {
            return false;
        }
    }

    public function ShareFund(Request $request)
    {
        $data = $request->except('_token');
        \DB::beginTransaction();
        try {
            //replace 10 with settings variable of minimum balance
            if (auth()->user()->UserWallet->amount < 10) {
                
                return response()->json([
                    "type" => "false",
                    "msg" => "Insufficient Balance, You can not make a transfer!"
                ], 200);
            }
            // adding to reciever account
            $add = UserWallet::whereUserId($data['user_id'])->first();
            $add->amount += $data['amount'];
            $add->save();

            //deducting from giver account
            $deduct = UserWallet::whereUserId(auth()->user()->id)->first();
            $deduct->amount -= $data['amount'];
            $deduct->save();

            //debit transaction to giver
            $debit = new PaymentTransaction();
            $debit->slug = bin2hex(random_bytes(64));
            $debit->user_id = auth()->user()->id;
            $debit->transaction_category_id = TransactionCategory::whereName('Debit')->first()->id;
            $debit->amount = $data['amount'];
            $debit->is_paid = true;
            $debit->reference_no = bin2hex(random_bytes(8));
            $debit->save();

            //credit transaction to user
            $credit = new PaymentTransaction();
            $credit->slug = bin2hex(random_bytes(64));
            $credit->user_id = $data['user_id'];
            $credit->transaction_category_id = TransactionCategory::whereName('Credit')->first()->id;
            $credit->amount = $data['amount'];
            $credit->is_paid = true;
            $credit->reference_no = bin2hex(random_bytes(8));
            $credit->save();

            activity_logs(auth()->user()->id, $_SERVER['REMOTE_ADDR'], "Share fund with ". User::whereId( $data['user_id'])->first()->full_name);

            \DB::commit();
            return response()->json([
                "type" => "true",
                "msg" => "Fund Shared Successfully!"
            ], 200);
        } catch (Exception $e) {
            \DB::rollback();
            return false;
        }
    }


    public function activate(Request $request)
    {
        $data = $request->except('_token');
        try {
            $user = User::find($data['member_id'],'slug');
            $user->is_active = true;
            $user->save();
            
            activity_logs(auth()->user()->id, $_SERVER['REMOTE_ADDR'], "Activated Member Account");
                
            return response()->json([
                "msg"   => "Account activated successfully!"
            ],200);
        } catch(Exception $e) {
            return false;
        }
    }


    public function resetPassword(Request $request)
    {
        $data = $request->except('_token');
        if($data) {
            try {
                $check = \Hash::check($data['old_password'],auth()->user()->password);
                if(!$check) {
                    return response()->json([
                        "msg"   => "Incorrect old password!",
                        "type"  =>  "false"
                    ]);
                }

                $member = User::find($data['slug'],'slug');
                $member->password = $data['new_password'];
                $member->save();

                activity_logs(auth()->user()->id, $_SERVER['REMOTE_ADDR'], "$member->full_name changed password");
                return response()->json([
                    "msg"   => "Password changed successfully!",
                    "type"  => "true"
                ],200);

            } catch (Exception $e) {
                return false;
            }
        }
    }

    
    protected function validator(array $data)
    {
        $custom_msg = [
            'full_name' => 'Fullname is Required',
            'telephone' => 'Telephone Number is Required',
        ];

        return Validator::make($data, [
            'full_name' => 'bail|required|string|max:255',
            'telephone' => 'bail|required|string|max:15',
        ], $custom_msg);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        if(\Auth::user()->is_admin) {
            $data['menu_id'] = 5;
            $data['profile'] = User::find($slug,'slug');
            $data['activities'] = ActivityLog::where('user_id',$data['profile']->id)->orderBy('id','desc')->get();

            return view('admin.members.show')->with($data);
        }
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
    public function update(Request $request)
    {
        $data = $request->except('_except');
            \DB::beginTransaction();
            try {
                $validate = $this->validator($request->except('_token'));
                if($validate->fails()) {
                    return $response = [
                        'msg' => "Invalid Input",
                        'type' => 'false'
                    ];
                }                

                $user = User::UserProfile();
                $user->full_name = $data['full_name'];
                $user->save();

                $profile = UserProfile::whereUserId(auth()->user()->id)->first();
                $profile->full_name = $data['full_name'];
                $profile->telephone = $data['telephone'];
                $profile->save();

                $ip = $_SERVER['REMOTE_ADDR'];
                activity_logs(auth()->user()->id, $ip, "Update Profile");

                \DB::commit();
                return response()->json([
                    'msg'   => "Update Successfull!.",
                    'type'  => "true"
                ],200);
            } catch (Exception $e) {
            \DB::rollback();
            return redirect()->back()->with("error", $e->getMessage());
        }
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
