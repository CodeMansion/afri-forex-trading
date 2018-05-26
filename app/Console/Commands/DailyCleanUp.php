<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Artisan;

class DailyCleanUp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cleanup:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Script to clean up the application daily';

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

            exec("php artisan config:cache");
            exec("php artisan view:clear");
            exce("php artisan optimize");

        } catch(Exception $e) {
            return false;
        }
    }
}
