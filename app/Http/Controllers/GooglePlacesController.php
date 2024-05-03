<?php

namespace App\Http\Controllers;

use App\Models\GoogleMapPlaceBranches;
use App\Models\GoogleMapPlaces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GooglePlacesController extends Controller
{
    public function fetchPlaces(Request $request)
    {
        $category = $request->input('category');

        if ($category) {
            $apiKey = env("GOOGLE_API");
            $apiUrl = 'https://maps.googleapis.com/maps/api/place/textsearch/json';

            $response = Http::get($apiUrl, [
                'query' => $category,
                'key' => $apiKey,
                'location' => "23.8859,45.0792",
                'types' => 'food'
            ]);

            $places = $response->json()['results'];

            return response()->json(['data' => $places]);
        }

        return view('weclome', ['places' => []]);
    }

    public function storeBranchesForPlaces(Request $request)
    {
        //store branches for one place then using job get details of this branch
        if ($request->has('branches') && count($request->input('branches')) > 0) {
            foreach ($request->input('branches') as $key => $brancheId) {
                if ($key != 0) {

                    if ($request->has('placeId') && GoogleMapPlaces::query()->where('id', $request->input('placeId'))->exists()) {
                        GoogleMapPlaceBranches::updateOrCreate(
                            ['id' => $brancheId],
                            [
                                'google_map_place_id' => $request->input('placeId'),
                            ]
                        );
                    }
                }
            }
            return redirect()->back()->with('success', 'Branches stored successfully.');
        }
        return redirect()->back()->with('error', 'An error occurred while storing branches.');
    }
}
