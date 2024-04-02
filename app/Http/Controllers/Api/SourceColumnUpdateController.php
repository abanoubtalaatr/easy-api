<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Models\Analytics;
use App\Models\RawData;
use Illuminate\Support\Facades\DB;

class SourceColumnUpdateController extends BaseController
{
    public function updateSourceColumn()
    {
        // Select rows from analytics where source is NULL or empty, limited to 500 rows at a time
        $analyticsData = Analytics::query()
            ->whereNull('source')
            ->orWhere('source', '')
            ->limit(500)
            ->get();

        $processedCount = 0;

        foreach ($analyticsData as $row) {
            $id = $row->id;

            // Find the corresponding link in raw_data
            $linkRow = RawData::query()
                ->select('link')
                ->where('id', $id)
                ->first();

            if ($linkRow) {
                $link = $linkRow->link;

                // Extract the website URL from the link
                $parsedUrl = parse_url($link);
                $host = isset($parsedUrl['host']) ? $parsedUrl['host'] : '';

                // Remove 'www.' from the URL
                $source = str_replace('www.', '', $host);

                // Update the source column in analytics
                if (!empty($source)) {
                    Analytics::query()
                        ->where('id', $id)
                        ->update(['source' => $source]);

                    $processedCount++;
                }
            }
        }

        if ($processedCount > 0) {
            echo "Processed $processedCount rows.\n";
        } else {
            echo "No rows found with empty 'source' in analytics.";
        }
    }
}
