<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Investment;
use App\UserWallet;
use App\MonthlyCharge;
use App\TransactionCategory;
use App\Notifications\DeductMonthlyCharge;
use App\User;

use Carbon\Carbon;
use Notification;

class DailyChargesCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'DailyChargesCheck:shoot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Script to daily check for investors that are eligible for monthly charges';

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
        $investors = Investment::notEligibleInvestors()->get();
        \DB::beginTransaction();
        try {
            ini_set('max_execution_time', 0);
            if(count($investors) > 0) {
                foreach($investors as $investor) {
                    $this->DeductMonthlyCharge($investor);
                    \DB::commit();
                    echo "done";
                }
            }

        } catch(\Exception $e) {
            \DB::rollback();
            echo $e->getMessage();
        }
    }


    protected function DeductMonthlyCharge($investor)
    {
        if(isset($investor)) {
            //preparing deduction variables
            $percentage = $investor->Package->monthly_charge;
            $investment_amount = (double)$investor->Package->investment_amount;
            $monthly_charge = ($percentage / 100) * $investment_amount;

            //deducting monthly charge from investor's wallet
            $balance = UserWallet::where('user_id',$investor->user_id)->first();
            $balance->amount -= $monthly_charge;
            $balance->update();

            //recording the monthly charge details
            $charge = MonthlyCharge::insert([
                'user_id'           => $investor->user_id,
                'slug'              => bin2hex(random_bytes(16)),
                'investment_id'     => $investor->id,
                'amount_charged'    => $monthly_charge,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ]); 

            //making investor eligible for future withdrawal
            $investment = Investment::find($investor->id);
            $investment->is_eligible = true;
            $investment->update();

            //update user trasaction records
            $transaction = \DB::table("payment_transactions")->insert([
                'slug'          => bin2hex(random_bytes(16)),
                'user_id'       => $investor->user_id,
                'platform_id'   => 2,
                'amount'        => $monthly_charge,
                'is_paid'       => false,
                'reference_no'  => date('Ymdhis'),
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
                'transaction_category_id'   => TransactionCategory::where('name','Monthly Charge')->first()->id
            ]);

            $admin = User::find($investor->user_id);
            Notification::send($admin, new DeductMonthlyCharge($investor));
        }
    }
}
