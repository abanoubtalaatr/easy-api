<?php

namespace App\Console\Commands;

use App\Jobs\TextAnalysisJob;
use Illuminate\Console\Command;

class TextAnalysisCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'text:analysis';

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
        TextAnalysisJob::dispatch();
    }
}
