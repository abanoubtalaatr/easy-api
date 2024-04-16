<?php

namespace App\Http\Controllers\Api;

use App\Models\RawData;
use App\Models\Analytics;
use App\Models\CampaignPrompt;
use App\Service\OpenAIService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TextAnalysisController extends Controller
{
    public function fetchTextAndAnalyze()
    {
        $processedCount = 0;


        // Fetch 50 rows from raw_data that haven't been processed
        $rawData = RawData::query()
            ->leftJoin('analytics', 'raw_data.id', '=', 'analytics.id')
            ->whereNull('analytics.id')
            ->select('raw_data.id', 'raw_data.ftext','raw_data.campaign_id')
            ->limit(50)
            ->get();


        foreach ($rawData as $row) {

            $campaignPrompt = CampaignPrompt::query()->where('campaign', $row['campaign_id'])->first();
            $id = $row->id;
            $text = $row->ftext;

            if($campaignPrompt && $campaignPrompt->prompt){
                $sentimentPrompt = "'{$text}' ," . $campaignPrompt->prompt;
                
            }else{
                $sentimentPrompt = "Given the text '{$text}', categorize the sentiment as 'positive,' 'negative,' or 'neutral.' Provide only one word as a response.";
            }
            // Sentiment Analysis

            $sentimentResponse = $this->analyzeSentiment($sentimentPrompt);
            $sentiment = strtolower($sentimentResponse);


            // Category Classification
            $categoryPrompt = "Based on the text '{$text}', classify the post into one of the following categories: 'Industry Updates,' 'Analysis & Insights,' 'Educational Content,' 'Market Research,' 'Expert Interviews,' 'Policy & Regulation,' or 'Unknown.' Please respond with a single category.";
            $categoryResponse = $this->analyzeSentiment($categoryPrompt);
            $category = strtolower($categoryResponse);

            // Insert the analysis results into the analytics table
            Analytics::query()->create([
                'id' => $id,
                'sentiment' => $sentiment,
                'type' => $category,
                'source' => 'unknown',
                'response_type' => $category == 'unknown' ? $this->analyzeSentiment("give me information about '{$text}'"):null,
            ]);

            echo "Data successfully inserted for ID $id.\n";
            $processedCount++;
        }

        echo "Total processed rows: $processedCount\n";
    }

    private function analyzeSentiment($prompt)
    {
        return (new OpenAIService())->analyzeSentiment($prompt);
    }
}
