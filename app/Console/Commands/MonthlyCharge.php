<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Investment;
use App\UserWallet;
use App\PaymentTransaction;
use App\TransactionCategory;
use App\User;
use App\Notifications\DeductMonthlyCharge;

use Carbon\Carbon;
use Notification;

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
        $investors = Investment::eligibleInvestors()->get();
        \DB::beginTransaction();
        try {
            ini_set('max_execution_time', 0);
            if(count($investors) > 0) {
                foreach($investors as $investor) {
                    $this->DeductMonthlyCharge($investor);
                    \DB::commit();
                }
            } else {echo "No members";}

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

            //check for monthly charge record
            $current_month_record = \DB::table("monthly_charges")->where([
                'user_id'       => $investor->user_id,
                'investment_id' => $investor->id
            ])->whereMonth('created_at','=',date('m',strtotime(Carbon::now())))->whereYear('created_at','=',date('Y', strtotime(Carbon::now())))->first();

            if($current_month_record) {
                echo "This member has been charge for this month";
            } else {
                //deducting monthly charge from investor's wallet
                $balance = UserWallet::where('user_id',$investor->user_id)->first();
                $balance->amount -= $monthly_charge;
                $balance->update();

                //recording the monthly charge details
                $charge = \DB::table("monthly_charges")->where([
                    'user_id'       => $investor->user_id,
                    'investment_id' => $investor->id
                ])->update([
                    'created_at'    => Carbon::now(),
                    'updated_at'    => Carbon::now()
                ]); 

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

                echo "Done";
            }
        }
    }
}
