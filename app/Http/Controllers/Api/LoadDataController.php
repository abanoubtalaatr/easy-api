<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Models\Page;
use App\Models\Raw;
use App\Repositories\LoadDataRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LoadDataController extends BaseController
{
    public LoadDataRepository $dataRepository;

    public function __construct(LoadDataRepository $dataRepository)
    {
        $this->dataRepository = $dataRepository;
    }

    public function index()
    {
        $this->deleteProcessedRows();
        $lastPageNumber = $this->getLastPageNumber();
        $nextPageNumber = $lastPageNumber + 1;

        $todayDate = now()->format('Ymd');
        $loadDataPerPage = env('LOAD_DATA_PER_PAGE')??100;
        $tokenMentionlytics = env('TOKEN_MENTIONLYTICS');
        $api_url = "https://app.mentionlytics.com/api/mentions?token=$tokenMentionlytics&startDate=20240201&endDate={$todayDate}&per_page=$loadDataPerPage&page_no={$nextPageNumber}";

        Log::info("Fetching data from API URL: {$api_url}\n");

        try {
            $response = Http::get($api_url);

            if ($response->successful()) {
                $responseBody = $response->body();
                if (strlen($responseBody) > 1500) {
                    $this->insertRawData($responseBody);
                    $this->updatePageTable($nextPageNumber);
                } else {
                    Log::info('Response length is not greater than 1500 characters.');
                }
            } else {
                Log::info("Failed to fetch data from API. Status code: {$response->status()}\n");
            }
        } catch (\Exception $e) {
            Log::info("Error fetching data from API: {$e->getMessage()}\n");
        }
    }

    private function deleteProcessedRows()
    {
        Raw::query()->where('status', 'processed')->delete();
        Log::info('delete all records that processed');
    }

    private function getLastPageNumber()
    {
        $lastPage = Page::query()->orderByDesc('dateupdate')->first();
        return $lastPage ? $lastPage->page : -1;
    }

    private function insertRawData($response)
    {
        Raw::query()->create(['response' => $response, 'status' => "not processing"]);
    }

    private function updatePageTable($nextPageNumber)
    {
        Page::query()->create(['page' => $nextPageNumber, 'dateupdate' => now()]);
    }
}
