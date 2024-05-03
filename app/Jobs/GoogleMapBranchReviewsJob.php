<?php

namespace App\Jobs;

use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use App\Models\GoogleMapBranchReview;
use App\Models\GoogleMapPlaceBranches;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class GoogleMapBranchReviewsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $apiKey = env("GOOGLE_API");
        $fields = "formatted_address,name,geometry,types,reviews";
        $url = "https://maps.googleapis.com/maps/api/place/details/json?place_id=";

        $branches = GoogleMapPlaceBranches::query()->get();
        $client = new Client();

        foreach ($branches as $branch) {

            $url .= $branch->id . '&fields=' . $fields . '&key=' . $apiKey;

            $response = $client->request('GET', $url);

            // Process the response data
            $data = json_decode($response->getBody(), true);
            $information['formatted_address'] = $data['result']['formatted_address'];
            $information['geometry'] = $data['result']['geometry'];
            $information['name'] = $data['result']['name'];
            $information['types'] = $data['result']['types'];

            foreach ($data['result']['reviews'] as $review) {
                GoogleMapBranchReview::query()->create([
                    'google_map_place_branche_id' => $branch->id,
                    'username' => $review['author_name'],
                    'rating' => $review['rating'],
                    'text' => $review['text'],
                ]);
            }
            $branch->update(['information' => $information]);

            Log::info('review update done for branches');
        }
    }
}
