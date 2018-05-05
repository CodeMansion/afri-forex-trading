<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Notifications\UnsubscriptionNotice;
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

class UnsubscribeMembers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'unsubscribe:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Unsubscribe Members that are not that have reached their subscription threshold';

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
        try {
            ini_set('max_execution_time', 0);
            $members = User::subscriptionMembers();
           
            if(count($members) > 0) {
                foreach($members as $member) {
                    if($member->is_first_time == 1) {
                        if($this->CheckExpiryDate($member,'first')) {
                            $subscription = Subscription::find($member->id);
                            $subscription->status = 2;
                            $subscription->save();
        
                            $user = User::find($member->user_id);
                            Notification::send($user, new UnsubscriptionNotice($subscription));

                            echo "Successful";
                        } else{echo "Not eligible"; }
                    } else {
                        if($this->CheckExpiryDate($member,'recurring')) {
                            $subscription = Subscription::find($member->id);
                            $subscription->status = 2;
                            $subscription->save();
        
                            $user = User::find($member->user_id);
                            Notification::send($user, new UnsubscriptionNotice($subscription));

                            echo "Successful";
                        } else{echo "Not eligible"; }
                    } 
                }
            } else{echo "no members";}

        } catch(Exception $e) {
            DB::rollback();
            echo $e->getMessage();
        }
    }

    protected function CheckExpiryDate($member,$type) {
        if($type == "first") {
            if(isset($member)) {
                $registered_date = strtotime($member->expiry);
                $now = now();
                return ($registered_date == $now);
            }
        }   

        if($type == "recurring") {
            if(isset($member)) {
                $registered_date = new \DateTime($member->created_at);
                $now = new \DateTime();
                return ($registered_date->diff($now)->days >= 30);
            }
        }
    }
}
