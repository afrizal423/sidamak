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
        Commands\UbahStatusAduan::class,
        Commands\NotifReminder::class,
        Commands\NotifAduanPending::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('changestatusaduan:daily')->twiceDaily(1, 6);
        $schedule->command('notifreminder:daily')->everyMinute();
        // $schedule->command('notifaduanpending:daily')->dailyAt('08:00');

        $schedule->command('websockets:clean')->everyMinute();
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
