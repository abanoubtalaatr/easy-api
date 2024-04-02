<?php

namespace App\Console\Commands;

use App\Jobs\UpdateSourceJob;
use Illuminate\Console\Command;

class UpdateSourceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:source';

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
        UpdateSourceJob::dispatch();
    }
}
