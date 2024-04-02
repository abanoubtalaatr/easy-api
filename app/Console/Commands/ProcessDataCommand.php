<?php
namespace App\Console\Commands;

use App\Jobs\ProcessDataJob;
use Illuminate\Console\Command;

class ProcessDataCommand extends Command
{
    protected $signature = 'process:data';

    protected $description = 'Process data every day';

    public function handle()
    {
        ProcessDataJob::dispatch();
    }
}
