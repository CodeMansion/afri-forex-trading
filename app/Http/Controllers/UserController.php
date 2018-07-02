<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Role;
use App\UserProfile;
use App\UserWallet;
use App\UserAccount;
use App\PaymentTransaction;
use App\TransactionCategory;
use App\ActivityLog;
use App\Withdrawal;
use App\Mail\NewAdministrator;
use App\Investment;

use Validator;
use Gate;
use Mail;

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
            $params['investments'] = Investment::UserInvestments()->get();
            $data['earnings'] = User::find(auth()->user()->slug,'slug')->UserEarnings()->orderBy('id','DESC')->get();
            $data['transactions'] = PaymentTransaction::userTransactions()->orderBy('id','DESC')->get();
            $data['activities'] = ActivityLog::userActivities()->orderBy('id','desc')->get();

            return view('members.profile.index')->with($data);
        }
            
        if(\Auth::user()->is_admin) {
            $data['menu_id'] = 5;
            $data['members'] = User::members()->get();
            $data['administrators'] = User::administrators()->get();
            $data['roles'] = Role::all();

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
        $member_wallet = UserWallet::balance()->first()->amount;
        $charge = (2 / 100) * (double)$data['amount'];
        $eligible_amount = $charge + (double)$data['amount'];
        $ledger_balance = $member_wallet - 10.00;
        
        \DB::beginTransaction();
        try {
            $me = User::find($data['user_id']);
            if($me->email == auth()->user()->email) {
                return response()->json([
                    "msg"   => "You cannot refund your own account",
                    "type"  => "false"
                ]);
            }

            $old_withdrawal = Withdrawal::where('user_id', auth()->user()->id)
                        ->where('status',0)->orWhere('status',1)->first();

            if($old_withdrawal) {
                return response()->json([
                    "msg"   => "You have a pending withdrawal request. Please try again after request has been attended to.",
                    "type"  => "false"
                ]);
            }

            //replace 10 with settings variable of minimum balance
            if($member_wallet < 10.00) {
                return response()->json([
                    "msg"   => "Insuffient fund. Unable to transfer fund!",
                    "type"  => "false"
                ]);
            }

            if($ledger_balance >= $eligible_amount) {
                // adding to reciever account
                $add = UserWallet::where('user_id',$data['user_id'])->first();
                $add->amount += (double)$data['amount'];
                $add->save();

                //deducting from giver account
                $deduct = UserWallet::activeMember();
                $deduct->amount -= $eligible_amount;
                $deduct->save();

                //debit transaction to giver
                $debit = new PaymentTransaction();
                $debit->slug = bin2hex(random_bytes(64));
                $debit->user_id = auth()->user()->id;
                $debit->transaction_category_id = TransactionCategory::whereName('Debit')->first()->id;
                $debit->amount = $eligible_amount;
                $debit->is_paid = true;
                $debit->reference_no = bin2hex(random_bytes(8));
                $debit->save();

                //credit transaction to user
                $credit = new PaymentTransaction();
                $credit->slug = bin2hex(random_bytes(64));
                $credit->user_id = $data['user_id'];
                $credit->transaction_category_id = TransactionCategory::whereName('Credit')->first()->id;
                $credit->amount = (double)$data['amount'];
                $credit->is_paid = true;
                $credit->reference_no = bin2hex(random_bytes(8));
                $credit->save();

                activity_logs(auth()->user()->id, $_SERVER['REMOTE_ADDR'], "Did fund transfer to a member");

                \DB::commit();
                return response()->json([
                    "type" => "true",
                    "msg" => "Fund transferred Successfully!"
                ], 200);

            } else {
                return response()->json([
                    "msg"   => "Insuffient Fund!. You cannot make transfer at this time.",
                    "type"  => "false"
                ]);
            }
            
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


    public function ConfirmPassword(Request $request)
    {
        $data = $request->except('_token');
        if($data) {
            $check = \Hash::check($data['password'],auth()->user()->password);
            if(!$check) {
                return response()->json([
                    "msg"   => "Invalid password check",
                    "type"  =>  "false"
                ]);

            } else {
                return response()->json([
                    'msg' => "Check was successful. Proceed with wallet refund",
                    'type' => "true"
                ],200);
            }
        }
    }


    public function RefundWallet(Request $request)
    {
        $data = $request->except('_token');
        if($data) {
            try {
                if((double)$data['amount'] > 0) {
                    $user = UserWallet::where('user_id',$data['user_id'])->first();
                    $user->amount += (double)$data['amount'];
                    $user->save();

                    $credit = new PaymentTransaction();
                    $credit->slug = bin2hex(random_bytes(26));
                    $credit->user_id = $data['user_id'];
                    $credit->transaction_category_id = TransactionCategory::whereName('Credit')->first()->id;
                    $credit->amount = (double)$data['amount'];
                    $credit->is_paid = true;
                    $credit->reference_no = date('Ymdhis');
                    $credit->save();

                    activity_logs(
                        auth()->user()->id, 
                        $_SERVER['REMOTE_ADDR'], 
                        "Refunded a member wallet"
                    );

                    return response()->json([
                        "type" => "true",
                        "msg" => "Wallet refunded successfully"
                    ], 200);
                }
            } catch(Exception $e) {
                return response()->json([
                    "error" => $e->getMessage()
                ], 422);
            }

        }
    }

    public function AddNewAdministrator(Request $request)
    {
        $data = $request->except('_token');
        if($data) {
            \DB::beginTransaction();
            try {

                $validator = $this->validator($data);
                if($validator->fails()) {
                    return $response = [
                        'msg'   => "Some of the entries your entered are invalid. Try again",
                        'head'  => "Invalid entries!",
                        'type'  => 'false'
                    ];
                }

                if($this->CheckEmail($data['email'])) {
                    return $response = [
                       'msg'   => "This email already exist!",
                       'head'  => "Duplicate Email Address!",
                       'type'  => 'false'
                   ];
                }

                if($this->CheckUsername($data['username'])) {
                    return $response = [
                        'msg'   => "This username already exist!",
                        'head'  => "Duplicate Username!",
                        'type'  => 'false'
                    ];
                }

                $password = $this->NewPassword();

                $user = new User();
                $user->slug = bin2hex(random_bytes(16));
                $user->email = $data['email'];
                $user->username = $data['username'];
                $user->full_name = $data['full_name'];
                $user->is_admin = true;
                $user->password = $password;
                $user->save();

                $profile = new UserProfile();
                $profile->user_id = $user->id;
                $profile->slug = bin2hex(random_bytes(16));
                $profile->full_name = $user->full_name;
                $profile->telephone = $data['telephone'];
                $profile->email = $user->email;
                $profile->country_id = 87;
                $profile->save();

                $role = User::find($user->id);
                $role->assignRole($data['role_id']);

                $param['full_name'] = $user->full_name;
                $param['password'] = $password;
                $param['email'] = $user->email;
                $param['slug'] = $user->slug;

                $this->SendEmail($param);

                \DB::commit();
                return $response = [
                    'msg'   => "New Administrator has been created successfully",
                    'head'  => "Successful",
                    'type'  => 'true'
                ];

            } catch(Exception $e) {
                \DB::rollback();
                return redirect()->back()->with("error", $e->getMessage());
            }
        }
    }


    protected function NewPassword() {
    	$new_password = str_random(10);
    	return $new_password;
    }

    protected function CheckEmail($data)
    {
        $check = User::hasEmail($data);
        if($check) 
           return true;
        
        return false;
    }

    protected function CheckUsername($data)
    {
        $check = User::hasUsername($data);
        if($check) 
           return true;
        
        return false;
    }

    protected function SendEmail($param) {
    	if($param) {
    		Mail::to($param['email'])->send(new NewAdministrator($param));
    	}
    }

    
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'full_name' => 'bail|required|string|min:6',
            'telephone' => 'bail|required|string|max:15|min:11',
            'email'     => 'bail|required|email|min:10',
            'username'  => 'bail|required|min:6',
            'role_id'   => 'bail|required'
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        if(auth()->user()->is_admin) {
            $data['menu_id'] = 5;
            $data['profile'] = User::find($slug,'slug');
            $data['earnings'] = User::find($slug,'slug')->UserEarnings()->orderBy('id','DESC')->get();
            $data['transactions'] =  User::find($slug,'slug')->UserTransactions()->orderBy('id','DESC')->get();
            $data['activities'] = ActivityLog::where('user_id',$data['profile']->id)->orderBy('id','desc')->get();
            $data['balance'] = UserWallet::where('user_id',$data['profile']->id)->first();

            return view('admin.members.show')->with($data);
        }
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



    public function UpdateAccount(Request $request)
    {
        $data = $request->except('_except');
        \DB::beginTransaction();
        try {
            
            $account = UserAccount::whereUserId(auth()->user()->id)->first();
            $account->account_name = (isset($data['account_name'])) ? $data['account_name'] : null;
            $account->account_number = (isset($data['account_number'])) ? $data['account_number'] : null;
            $account->bank_name = (isset($data['bank_name'])) ? $data['bank_name'] : null;
            $account->bank_code = (isset($data['bank_code'])) ? $data['bank_code'] : null;
            $account->sort_code = (isset($data['sort_code'])) ? $data['sort_code'] : null;
            $account->swift_code = (isset($data['swift_code'])) ? $data['swift_code'] : null;
            $account->iban_number = (isset($data['iban_number'])) ? $data['iban_number'] :null;
            $account->save();

            $ip = $_SERVER['REMOTE_ADDR'];
            activity_logs(auth()->user()->id, $ip, "Updated account information");

            \DB::commit();
            return response()->json([
                'msg'   => "Updated Successfully.",
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
    public function DeleteMember(Request $request)
    {
        $data = $request->except('_token');
        if($data) {
            try {
                
                $userID = User::find($data['slug'],'slug')->id;
                $user = \DB::table('users')->where('id',$userID)->delete();
                $profile = \DB::table('user_profiles')->where('user_id',$userID)->delete();
                $activity = \DB::table('activity_logs')->where('user_id',$userID)->delete();
                $earning = \DB::table('earnings')->where('user_id',$userID)->delete();
                $transaction = \DB::table('payment_transactions')->where('user_id',$userID)->delete();
                $testimony = \DB::table('testimonies')->where('user_id',$userID)->delete();
                $role = \DB::table('role_user')->where('user_id',$userID)->delete();
                $dispute = \DB::table('disputes')->where('user_id',$userID)->delete();
                $dispute_reply = \DB::table('dispute_replies')->where('user_id',$userID)->delete();
                $investment = \DB::table('investments')->where('user_id',$userID)->delete();
                $subscription = \DB::table('subscriptions')->where('user_id',$userID)->delete();
                $referral = \DB::table('referrals')->where('user_id',$userID)->delete();
                $wallet = \DB::table('user_wallets')->where('user_id',$userID)->delete();
                $withdrawal = \DB::table('withdrawals')->where('user_id',$userID)->delete();
                $service = \DB::table('member_services')->where('user_id',$userID)->delete();
                
                activity_logs(auth()->user()->id,$_SERVER['REMOTE_ADDR'],"Deleted a member");

                return response()->json([
                    'msg'   => "Member records deleted Successfully!",
                    'type'  => "true"
                ], 200);
                
            } catch(Exception $e) {
                return response()->json([
                    'msg'   => $e->getMessage(),
                    'type'  => "false"
                ]);
            }
        }
    }
}
