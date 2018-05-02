<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
        //
    }
}
