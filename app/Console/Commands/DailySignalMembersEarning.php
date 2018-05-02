<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Notifications\MemberEarning;
use App\User;
use App\Subscription;
use App\GeneralSetting;
use App\Earning;
use App\EarningType;
use App\UserWallet;
use App\PaymentTransaction;
use Notification;
use App\TransactionCategory;
use Carbon\Carbon;
use DB;

class DailySignalMembersEarning extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'DailySignalEarnings:shoot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate monthly earnings for members subscribed to daily signal service';

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
        DB::beginTransaction();
        try {
            ini_set('max_execution_time', 0);
            $members = User::subscriptionMembers();
            $setting = GeneralSetting::find(1);
            $earning_fee = 25;
            
            //loop through each members
            foreach($members as $member) {
                $downlines = User::find($member->user_id)->UserDownline(1)->get();
                $downline_count = count($downlines);
                
                if(isset($downline_count) && $downline_count == 2) {
                    $earning_amount = (double)$downline_count * $earning_fee;
                   
                    //insert new earning record
                    $new_earning = DB::table("earnings")->insert([
                        'slug'          => bin2hex(random_bytes(64)),
                        'user_id'       => $member->user_id,
                        'platform_id'   => 1,
                        'earning_type_id'   => EarningType::where('name','Referral')->first()->id,
                        'amount'        => (double)$earning_amount,
                        'status'        => 1,
                        'created_at'    => Carbon::now(),
                        'updated_at'    => Carbon::now()
                    ]);

                    //update member wallet with new earning amount
                    $member_wallet = UserWallet::where('user_id', $member->user_id)->first();
                    $member_wallet->amount = (double)$member_wallet->amount + $earning_amount;
                    $member_wallet->save();

                    //insert transaction record as credit
                    $transaction = DB::table("payment_transactions")->insert([
                        'slug'          => bin2hex(random_bytes(64)),
                        'user_id'       => $member->user_id,
                        'platform_id'   => 1,
                        'transaction_category_id'   => TransactionCategory::where('name','Credit')->first()->id,
                        'amount'        => (double)$earning_amount,
                        'is_paid'       => true,
                        'reference_no'  => date('Ymdhis'),
                        'created_at'    => Carbon::now(),
                        'updated_at'    => Carbon::now()
                    ]);

                    DB::commit();

                    //send notification to each member
                    $user = User::find($member->user_id);
                    Notification::send($user, new MemberEarning($new_earning));
                }
            }

        } catch(Exception $e) {
            DB::rollback();
            echo $e->getMessage();
        }
    }
}
