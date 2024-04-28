<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GooglePlacesController extends Controller
{
    public function fetchPlaces(Request $request)
    {
        $category = $request->input('category');

        if ($category) {
            $apiKey = 'AIzaSyD4SY6zA6mlJzzEXlludq8g8wiMmtwS-n4';
            $apiUrl = 'https://maps.googleapis.com/maps/api/place/textsearch/json';

            $response = Http::get($apiUrl, [
                'query' => $category,
                'key' => $apiKey,
            ]);

            $places = $response->json()['results'];

            return response()->json(['data' => $places]);
        }

        return view('weclome', ['places' => []]);
    }
}
