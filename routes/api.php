<?php

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\GoogleMapPlaceBranches;
use App\Http\Controllers\GooglePlacesController;
use App\Models\GoogleMapBranchReview;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('load-data', [\App\Http\Controllers\Api\LoadDataController::class, 'index'])->name('load_data');
Route::post('process-data', [\App\Http\Controllers\Api\DataProcessingController::class, 'processRows']);
Route::post('analysis-data', [\App\Http\Controllers\Api\TextAnalysisController::class, 'fetchTextAndAnalyze']);
Route::get('google-places', [GooglePlacesController::class, 'fetchPlaces'])->name('google-places.fetch');
Route::post('google-places-store-branches', [GooglePlacesController::class, 'storeBranchesForPlaces'])->name('api.google_map_places.store-branches');

Route::get('google-map-review', function (Request $request) {
    $apiKey = env("GOOGLE_API");
    $fields = "formatted_address,name,geometry,types,reviews";
    $url = "https://maps.googleapis.com/maps/api/place/details/json?place_id=";

    $branches = GoogleMapPlaceBranches::query()->get();
    $client = new Client();

    foreach ($branches as $key => $branch) {
        $url .= $branch->id . '&fields=' . $fields . '&key=' . $apiKey;

        $response = $client->request('GET', $url);

        // Process the response data
        $data = json_decode($response->getBody(), true);

        if (isset($data['result'])) {
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
        }
        sleep(30);
    }
});
