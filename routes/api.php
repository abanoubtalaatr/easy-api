<?php

use App\Http\Controllers\GooglePlacesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
