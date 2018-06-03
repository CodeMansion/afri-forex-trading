<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Investment;
use App\UserWallet;
use App\PaymentTransaction;
use App\TransactionCategory;
use Carbon\Carbon;

class MonthlyCharge extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'MonthlyCharge:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Monthly service charge for investment members';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $investors = Investment::allInvestors()->get();
        \DB::beginTransaction();
        try {
            ini_set('max_execution_time', 0);
            if(count($investors) > 0) {
                foreach($investors as $investor) {
                    $percentage = $investor->Package->monthly_charge;
                    $investment_amount = (double)$investor->Package->investment_amount;
                    $monthly_charge = ($percentage / 100) * $investment_amount;

                    $wallet = UserWallet::where('user_id',$investor->user_id)->first();
                    $wallet->amount -= $monthly_charge;
                    $wallet->save();

                    $transaction = \DB::table("payment_transactions")->insert([
                        'slug'          => bin2hex(random_bytes(16)),
                        'user_id'       => $investor->user_id,
                        'platform_id'   => 2,
                        'transaction_category_id'   => TransactionCategory::where('name','Monthly Charge')->first()->id,
                        'amount'        => $monthly_charge,
                        'is_paid'       => false,
                        'reference_no'  => date('Ymdhis'),
                        'created_at'    => Carbon::now(),
                        'updated_at'    => Carbon::now()
                    ]);
                    
                    \DB::commit();
                    echo "success";
                }
            } else {echo "No members";}

        } catch(Exception $e) {
            \DB::rollback();
            return false;
        }
    }
}
