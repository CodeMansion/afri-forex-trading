<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Subscription extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Subscription:calculation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is use to calculate Subscription Bonus';

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
