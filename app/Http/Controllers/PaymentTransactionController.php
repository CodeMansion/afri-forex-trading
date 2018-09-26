<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaymentTransaction;
use App\UserWallet;
use Gate;

class PaymentTransactionController extends Controller
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

            $data['menu_id'] = 6.0;
            $data['transactions'] = PaymentTransaction::userTransactions()->orderBy('id','DESC')->get();
            $data['debit']  = PaymentTransaction::userLatestDebit()->first();
            $data['credit']  = PaymentTransaction::userLatestCredit()->first();
            $data['wallet'] = UserWallet::balance()->first();

            return view('members.transactions.index')->with($data);
        }

        if(\Auth::user()->is_admin) {
            $data['menu_id'] = 6.0;
            $data['transactions'] = PaymentTransaction::orderBy('id','DESC')->get();
            
            return view('admin.transactions.index')->with($data);
        }
    }
}
