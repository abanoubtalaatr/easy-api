<?php

namespace App\Jobs;

use App\Http\Controllers\Api\LoadDataController;
use App\Repositories\LoadDataRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class LoadDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(LoadDataRepository $loadDataRepository): void
    {
        $loadDataController = new LoadDataController($loadDataRepository);
        $loadDataController->index();;
    }
}
