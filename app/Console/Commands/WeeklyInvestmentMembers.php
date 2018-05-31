<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\User;
use App\UserWallet;
use App\Investment;
use App\Earning;
use App\EarningType;
use App\PaymentTransaction;
use App\TransactionCategory;
use App\Package;
use App\PackageType;
use App\GeneralSetting;
use App\Notifications\MemberEarning;
use DB;
use Notification;
use Carbon\Carbon;

class WeeklyInvestmentMembers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'WeeklyInvestment:shoot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculates weekly investment earnings for members';

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
        $investors = Investment::weeklyInvestors()->get();
        DB::beginTransaction();

        try {
            ini_set('max_execution_time', 0);
            if(count($investors) > 0) {
                foreach($investors as $investor) {
                    
                        $investment_amount = (double)$investor->Package->investment_amount;
                        $percentage = (double)$investor->PackageType->percentage;
                        $earning_amount = earnings_formular('weekly',$percentage,$investment_amount);

                        $new_earning = DB::table("earnings")->insert([
                            'slug'          => bin2hex(random_bytes(64)),
                            'user_id'       => $investor->user_id,
                            'platform_id'   => 2,
                            'earning_type_id'   => EarningType::where('name','Weekly')->first()->id,
                            'amount'        => (double)$earning_amount,
                            'status'        => 1,
                            'created_at'    => Carbon::now(),
                            'updated_at'    => Carbon::now()
                        ]);

                        $member_wallet = UserWallet::where('user_id', $investor->user_id)->first();
                        $member_wallet->amount = (double)$member_wallet->amount + $earning_amount;
                        $member_wallet->save();

                        $transaction = DB::table("payment_transactions")->insert([
                            'slug'          => bin2hex(random_bytes(64)),
                            'user_id'       => $investor->user_id,
                            'platform_id'   => 2,
                            'transaction_category_id'   => TransactionCategory::where('name','Credit')->first()->id,
                            'amount'        => (double)$earning_amount,
                            'is_paid'       => true,
                            'reference_no'  => date('Ymdhis'),
                            'created_at'    => Carbon::now(),
                            'updated_at'    => Carbon::now()
                        ]);

                        DB::commit();
                        $user = User::find($investor->user_id);
                        Notification::send($user, new MemberEarning($new_earning));

                        echo "Successful";
                    
                }
            } else{echo "No members";}
            
        } catch(Exception $e) {
            DB::rollback();
            echo $e->getMessage();
        }
    }
}
