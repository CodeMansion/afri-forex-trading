<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
        //
    }
}
