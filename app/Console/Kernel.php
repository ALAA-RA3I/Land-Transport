<?php

namespace App\Console;

use App\Jobs\CreateWeeklyTripsJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        // Your custom commands
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->job(new CreateWeeklyTripsJob())->everyMinute();
    }

    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
