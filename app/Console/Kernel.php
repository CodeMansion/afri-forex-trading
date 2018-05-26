<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('DailySignalEarnings:shoot')->monthly();
        $schedule->command('DailyInvestment:shoot')->daily();
        $schedule->command('WeeklyInvestment:shoot')->weekly();
        $schedule->command('MonthlyInvestment:shoot')->monthly();
        $schedule->command('QuarterlyInvestment:shoot')->quarterly();
        $schedule->command('Unsubscribe:run')->daily();
        $schedule->command('cleanup:run')->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
