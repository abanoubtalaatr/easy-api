<?php

namespace App\Console\Commands;

use App\Jobs\LoadDataJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class LoadDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'load:data {--count=1 : The number of times to fetch data from the API}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $fetchCount = $this->option('count');

        $fetchCount = is_numeric($fetchCount) ? intval($fetchCount) : 100;

        for ($i = 0; $i < $fetchCount; $i++) {
            // Your logic to fetch data from the API goes here
            LoadDataJob::dispatch();

            Log::info('load data in page number ' . $i);
            // Wait for one minute before the next execution
            sleep(60);
        }
    }
}
