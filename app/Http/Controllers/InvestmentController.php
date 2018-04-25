<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransactionCategory;
use App\PaymentTransaction;
use App\Package;
use App\PackageType;
use App\Investment;
use App\UserDownline;
use App\Mail\Investments;

use Gate;

class InvestmentController extends Controller
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

            $params['downlines'] = UserDownline::all();
            return view('members.platforms.investments.index')->with($params);
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
        if(isset($data) && $data['req'] == 'investment_pay') {
            \DB::beginTransaction();
            try {
                $investment                  = new Investment();
                $investment->slug            = bin2hex(random_bytes(64));
                $investment->user_id         = auth()->user()->id;
                $investment->platform_id     = $data['platform_id'];
                $investment->package_id      = $data['package_id'];
                $investment->package_type_id = $data['package_type_id'];
                $investment->status          = 1;
                $investment->save();
                
                $transaction                            = new PaymentTransaction();
                $transaction->slug                      = bin2hex(random_bytes(64));
                $transaction->user_id                   = auth()->user()->id;
                $transaction->platform_id               = $data['platform_id'];
                $transaction->transaction_category_id   = TransactionCategory::whereName('Debit')->first()->id;
                $transaction->amount                    = Package::whereId($data['package_id'])->first()->investment_amount;
                $transaction->is_paid                   = true;
                $transaction->reference_no              = bin2hex(random_bytes(8));
                $transaction->save();

                $upline = UserDownline::whereDownlineId(auth()->user()->id)->first();
                if(isset($upline)){
                    if($upline->platform_id == Null){
                        $upline->platform_id        = $investment->platform_id;
                        $upline->is_active          = 1;
                        $upline->investment_amount  = $transaction->amount;
                        $upline->save();
                    }else{
                        // new platform downline
                        $downline                   = new UserDownline();
                        $downline->platform_id      = $investment->platform_id;
                        $downline->upline_id 	    = $upline->upline_id;
                        $downline->downline_id 	    = $investment->user_id;
                        $downline->is_active        = 1;
                        $downline->investment_amount= $transaction->amount;
                        $downline->save();
                    }

                }
                
                //\Mail::to(auth()->user()->email)->send(new Investments($investment));
                $ip = $_SERVER['REMOTE_ADDR'];
                activity_logs(auth()->user()->id, $ip, "Payed for Investment");
            \DB::commit();
                return response()->json([
                    'msg' => "You Have Successfully investment For Investment.",
                    'type' => "true"
                ],200);

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
