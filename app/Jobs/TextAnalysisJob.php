<?php

namespace App\Jobs;

use App\Http\Controllers\Api\TextAnalysisController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TextAnalysisJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $textAnalysisController = new TextAnalysisController();
        $textAnalysisController->fetchTextAndAnalyze();
    }
}
