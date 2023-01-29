<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;

use App\Console\Commands\ImportStatsCommand;
use App\Console\Commands\ImportTeamsCommand;
use App\Console\Commands\ImportPlayersCommand;
use App\Console\Commands\ImportMatchesCommand;


use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        ImportStatsCommand::class,
        ImportTeamsCommand::class,
        ImportPlayersCommand::class,
        ImportMatchesCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
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
