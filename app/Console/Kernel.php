<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\ProcessDataCommand::class,
        Commands\RestartQueueCommand::class,
        Commands\LoadDataCommand::class,
        Commands\UpdateSourceCommand::class,
        Commands\TextAnalysisCommand::class,
    ];
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('queue:restart')->everyMinute();

        $fetchCount = env('NUMBER_OF_PAGE', 100);

        $schedule->command('load:data --count=' . $fetchCount)
            ->daily();

        $schedule->command('load:data')->daily();
        $schedule->command('process:data')->daily();
        $schedule->command('text:analysis')->daily();
        $schedule->command('update:source')->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
