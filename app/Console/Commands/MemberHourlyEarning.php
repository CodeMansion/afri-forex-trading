<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\User;
use App\UserProfile;

class MemberHourlyEarning extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'HourlyEarning:shoot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate members earnings on an hourly basis';

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
        $users = new User();
        $users->full_name = "Cron Job Tester";
        $users->email = "admin@gmail1.com";
        $users->username = "CronJob1";
        $users->password = "admin1234";
        $users->slug = bin2hex(random_bytes(64));
        $users->save();

        $profile = new UserProfile();
        $profile->user_id = $users->id;
        $profile->slug = bin2hex(random_bytes(64));
        $profile->full_name = "Cron Job";
        $profile->email = "admin@gmail1.com";
        $profile->telephone = "08000002222";
        $profile->country_id = 23;
        $profile->save();
    }
}
