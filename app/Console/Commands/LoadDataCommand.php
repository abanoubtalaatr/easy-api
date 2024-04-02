<?php

namespace App\Console\Commands;

use App\Jobs\LoadDataJob;
use Illuminate\Console\Command;

class LoadDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'load:data';

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
        LoadDataJob::dispatch();
    }
}
