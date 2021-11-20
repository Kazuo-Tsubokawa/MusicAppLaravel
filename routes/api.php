<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RegisterController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [RegisterController::class, 'register']);

Route::post('/login', [LoginController::class, 'login']);

Route::group(['middleware' => ['api']], function () {
    Route::apiResource('songs', App\Http\Controllers\Api\SongController::class)
        ->middleware('auth:sanctum')
        ->only(['show']);
});

Route::group(['middleware' => ['api']], function () {
    Route::apiResource('songs.likes', App\Http\Controllers\Api\LikeController::class)
        ->middleware('auth:sanctum');
});

Route::group(['middleware' => ['api']], function () {
    Route::apiResource('artists.follows', App\Http\Controllers\Api\FollowController::class)
        ->middleware('auth:sanctum');
});
