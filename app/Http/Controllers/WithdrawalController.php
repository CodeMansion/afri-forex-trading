<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\UserWallet;
use App\Platform;
use App\Withdrawal;
use App\Notifications\WithdrawalRequest;

use Notification;
use DB;
use Carbon\Carbon;

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
        $data = $request->except('_token');
        if(isset($data)) {
            DB::beginTransaction();
            try {
                $member_wallet = UserWallet::balance()->first()->amount;
                $withdrawal_charge = (5 / 100) * (double)$data['amount'];
                $ledger_balance = $member_wallet - 10.00;
                $eligible_amount = $withdrawal_charge + (double)$data['amount'];

                $old_withdrawal = Withdrawal::where(['user_id'=>auth()->user()->id,'status'=>0])->first();

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
                
                if($ledger_balance >= $eligible_amount) {
                    $withdrawal = Withdrawal::insert([
                        'user_id'       => auth()->user()->id,
                        'slug'          => bin2hex(random_bytes(64)),
                        'status'        => 0,
                        'amount'        => (double)$data['amount'],
                        'created_at'    => Carbon::now(),
                        'updated_at'    => Carbon::now()
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

            } catch(Exception $e) {
                DB::rollback();
                return response()->json([
                    "msg"   => $e->getMessage(),
                    "type"  => "false"
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
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
