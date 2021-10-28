<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\MovieCoverController;
use App\Http\Controllers\MovieRatingController;
use App\Http\Controllers\MovieSearchController;
use App\Http\Controllers\RatingController;
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

Route::apiResource('movies', MovieController::class)->only('index', 'show');

Route::post('search', MovieSearchController::class);

Route::get('movie/rating/{movie}', MovieRatingController::class);

//Auth
Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/register', [AuthController::class, 'register']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::group(['middleware' => 'adminCheck'], function () {
        Route::apiResource('movies', MovieController::class)->except('index', 'show');
        Route::post('movie/cover', [MovieCoverController::class, 'update']);
        Route::delete('movie/cover/{movieId}', [MovieCoverController::class, 'destroy']);
    });

    //Rating
    Route::post('movie/rating', [RatingController::class, 'update']);
    Route::delete('movie/rating/{rating}', [RatingController::class, 'destroy']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    //Auth
    Route::get('auth/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::get('auth/logout-all', [AuthController::class, 'logoutAllDevices']);
});



