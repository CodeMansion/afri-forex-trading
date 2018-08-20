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

class MonthlyInvestmentMembers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'MonthlyInvestment:shoot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculates monthly investments earnings for members';

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
        
    }
}
