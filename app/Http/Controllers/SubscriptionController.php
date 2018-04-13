<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscription;
use DB;
use Carbon\Carbon;
use App\PaymentTransaction;
use App\Mail\DailySignal;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dailySignalIndex()
    {
        return view('members.daily_signal');
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
        if(isset($data) && $data['req'] == 'subscribe') {
            \DB::beginTransaction();
            try {
                $subscribe                  = new Subscription();
                $subscribe->slug            = bin2hex(random_bytes(64));
                $subscribe->user_id         = auth()->user()->id;
                $subscribe->amount          = 75;
                $subscribe->is_first_time   = true;
                $subscribe->status          = 1;
                $subscribe->expiry_date     = Carbon::now()->addDays(60);
                $subscribe->save();
                
                $transaction                            = new PaymentTransaction();
                $transaction->slug                      = bin2hex(random_bytes(64));
                $transaction->user_id                   = auth()->user()->id;
                $transaction->transaction_category_id   = \App\TransactionCategory::whereName('Debit')->first()->id;
                $transaction->amount                    = 75;
                $transaction->is_paid                   = true;
                $transaction->reference_no              = bin2hex(random_bytes(8));
                $transaction->save();
                
                //\Mail::to(auth()->user()->email)->send(new DailySignal($subscribe));
                $ip = $_SERVER['REMOTE_ADDR'];
                activity_logs(auth()->user()->id, $ip, "Subscribe for daily signal");
            \DB::commit();
                return $response = [
                    'msg' => "You Have Successfully Subscribe For Daily Signal.",
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
