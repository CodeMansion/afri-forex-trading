<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Referral extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Referral:calculation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Calculate Referral Bonus';

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
