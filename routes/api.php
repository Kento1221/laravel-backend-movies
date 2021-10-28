<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\MovieCoverController;
use App\Http\Controllers\MovieSearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResource('movies', MovieController::class);

Route::post('search', MovieSearchController::class);

Route::post('movie/cover', [MovieCoverController::class, 'update']);
Route::delete('movie/cover/{movieId}', [MovieCoverController::class, 'destroy']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
