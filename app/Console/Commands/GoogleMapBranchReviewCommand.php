<?php

namespace App\Console\Commands;

use App\Jobs\GoogleMapBranchReviewsJob;
use App\Jobs\UpdateSourceJob;
use Illuminate\Console\Command;

class GoogleMapBranchReviewCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'google-map-branches:update-reviews';

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
        GoogleMapBranchReviewsJob::dispatch();
    }
}
