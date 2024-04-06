<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class RestartQueueCommand extends Command
{
    protected $signature = 'queue:restart';

    protected $description = 'Restart the queue workers';

    public function handle()
    {
        // Stop the queue workers
        Artisan::call('queue:restart');

        // Start the queue workers
        Log::info('queue restart');
        Artisan::call('queue:work');
    }
}
