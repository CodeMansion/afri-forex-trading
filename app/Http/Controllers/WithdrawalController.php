<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\UserWallet;
use App\Platform;
use App\Withdrawal;
use App\PaymentTransaction;
use App\TransactionCategory;
use App\Notifications\CompletedWithdrawalRequest;
use App\Notifications\ApproveWithdrawalRequest;
use App\Notifications\DeclineWithdrawalRequest;
use App\Notifications\WithdrawalRequest;
use App\Mail\CompletedWithdrawal;

use Notification;
use DB;
use Carbon\Carbon;
use Mail;

class WithdrawalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->is_admin) {
            $data['menu_id'] = 10;
            $data['withdrawals'] = Withdrawal::orderBy('id','DESC')->get();

            return view('admin.withdrawals.index')->with($data);
        }

        if(auth()->user()->is_admin == 0) {
            $data['menu_id'] = 9;
            $data['withdrawals'] = Withdrawal::memberWithdrawal()->get();

            return view('members.withdrawals.index')->with($data);
        }
    }

    protected function check_withdrawal_count()
    {
        $withdrawal = Withdrawal::where('user_id',auth()->user()->id)
        ->whereMonth('created_at', '=', date('m',strtotime(Carbon::now())))
        ->whereYear('created_at', '=', date('Y', strtotime(Carbon::now())))
        ->where('status',2)
        ->get();

        if(count($withdrawal) == 2)
            return true;

        return false;
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
        if(isset($data)) {
            DB::beginTransaction();
            try {
                $member_wallet = UserWallet::balance()->first()->amount;
                $withdrawal_charge = (5 / 100) * (double)$data['amount'];
                $ledger_balance = $member_wallet - 10.00;
                $eligible_amount = $withdrawal_charge + (double)$data['amount'];

                $old_withdrawal = Withdrawal::where([
                    'user_id'   => auth()->user()->id,
                    'status'    => 1
                ])->first();

                if($old_withdrawal) {
                    return response()->json([
                        "msg"   => "You have a pending withdrawal request. Please try again after request has been attended to.",
                        "type"  => "false"
                    ]);
                }

                if($member_wallet < 10.00) {
                    return response()->json([
                        "msg"   => "Insuffient fund. You cant make withdrawal!",
                        "type"  => "false"
                    ]);
                }

                if($this->check_withdrawal_count()) {
                    return response()->json([
                        "msg"   => "Maximum withdrawal reached, You cant make withdrawal again this month!",
                        "type"  => "false"
                    ]);
                }
                
                if($ledger_balance >= $eligible_amount) {
                    $withdrawal = Withdrawal::insert([
                        'user_id'                   => auth()->user()->id,
                        'slug'                      => bin2hex(random_bytes(64)),
                        'initial_wallet_balance'    => $member_wallet,
                        'withdrawal_charge'         => $withdrawal_charge,
                        'deducted_amount'           => $eligible_amount,
                        'status'                    => 0,
                        'withdrawal_amount'         => (double)$data['amount'],
                        'created_at'                => Carbon::now(),
                        'updated_at'                => Carbon::now()
                    ]);
                } else {
                    return response()->json([
                        "msg"   => "We were unable to deduct your withdrawal charge. No enough fund.",
                        'head'  => "Insuffient Fund!",
                        "type"  => "false"
                    ]);
                }

                DB::commit();

                $admin = User::find(1);
                Notification::send($admin, new WithdrawalRequest($withdrawal));

                return response()->json([
                    "msg"   => "Your Withdrawal Request has been sent successfully.",
                    "type"  => "true"
                ],200);

            } catch(\Exception $e) {
                DB::rollback();
                return response()->json([
                    "msg"   => $e->getMessage(),
                    "type"  => "false",
                    'head'  => "Please try again"
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = $request->except('_token');
        if($data) {
            $data['withdrawal'] = Withdrawal::find($data['withdrawal_id']);
            $data['wallet'] = UserWallet::where('user_id',$data['withdrawal']->user_id)->first();
            $data['ledger_balance'] = (double)$data['wallet']->amount - 10.00;
            $data['withdrawal_charge'] = (5 / 100) * (double)$data['withdrawal']->amount;

            return view('admin.withdrawals.partials._get_details')->with($data);
        }
    }

    public function approve(Request $request)
    {
        $data = $request->except('_token');
        if($data) {
            try {

                $withdrawal = Withdrawal::find($data['withdrawal_id']);
                $withdrawal->status = 1;
                $withdrawal->save();

                activity_logs(
                    auth()->user()->id, 
                    $_SERVER['REMOTE_ADDR'], 
                    "Approved a withdrawal request"
                );

                $user = User::find($withdrawal->user_id);
                Notification::send($user, new ApproveWithdrawalRequest($withdrawal));

                return response()->json([
                    "msg"   => "Withdrawal request has been approved",
                    "type"  => "true"
                ],200);

            } catch(\Exception $e) {
                return response()->json([
                    "head"  => "Please try again",
                    "msg"   => $e->getMessage(),
                    "type"  => "false"
                ]);
            }
        }
    }


    public function decline(Request $request)
    {
        $data = $request->except('_token');
        if($data) {
            try {

                $withdrawal = Withdrawal::find($data['withdrawal_id']);
                $withdrawal->status = 3;
                $withdrawal->save();

                activity_logs(
                    auth()->user()->id, 
                    $_SERVER['REMOTE_ADDR'], 
                    "Declined a withdrawal request"
                );

                $user = User::find($withdrawal->user_id);
                Notification::send($user, new DeclineWithdrawalRequest($withdrawal));

                return response()->json([
                    "msg"   => "Withdrawal request has been declined",
                    "type"  => "true"
                ],200);

            } catch(\Exception $e) {
                return response()->json([
                    "head"  => "Please try again",
                    "msg"   => $e->getMessage(),
                    "type"  => "false"
                ]);
            }
        }
    }


    public function completed(Request $request)
    {
        $data = $request->except('_token');
        if($data) {
            DB::beginTransaction();
            try {
                $withdrawal = Withdrawal::find($data['withdrawal_id']);
                $withdrawal->status = 2;
                $withdrawal->save();

                $wallet = UserWallet::where('user_id',$withdrawal->user_id)->first();
                $wallet->amount -= $withdrawal->deducted_amount;
                $wallet->save();

                $transaction = PaymentTransaction::insert([
                    'slug'          => bin2hex(random_bytes(16)),
                    'user_id'       => $withdrawal->user_id,
                    'platform_id'   => 2,
                    'transaction_category_id'   => TransactionCategory::where('name','Debit')->first()->id,
                    'amount'        => $withdrawal->deducted_amount,
                    'is_paid'       => true,
                    'reference_no'  => date('Ymdhis'),
                    'created_at'    => Carbon::now(),
                    'updated_at'    => Carbon::now()
                ]);

                activity_logs(
                    auth()->user()->id, 
                    $_SERVER['REMOTE_ADDR'], 
                    "Marked a withdrawal request as complete"
                );

                $user = User::find($withdrawal->user_id);
                Notification::send($user, new CompletedWithdrawalRequest($withdrawal));

                $param['amount'] = $withdrawal->withdrawal_amount;
                $param['charge'] = $withdrawal->withdrawal_charge;
                $param['name'] = $user->full_name;
                $param['total'] = $withdrawal->deducted_amount;
                // Mail::to($user->email)->send(new CompletedWithdrawal($param));

                DB::commit();
                return response()->json([
                    "msg"   => "Withdrawal request has been marked completed",
                    "type"  => "true"
                ],200);

            } catch(\Exception $e) {
                DB::rollback();
                return response()->json([
                    "msg"   => $e->getMessage(),
                    'type'  => 'false',
                    'head'  => 'Please try again'
                ]);
            }
        }
    }
}
