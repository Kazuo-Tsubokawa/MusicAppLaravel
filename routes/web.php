<?php

use App\Http\Controllers\ArtistController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\SongController;

use App\Models\Artist;
use App\Models\Follow;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/', [ArticleController::class, 'index'])->name('root');

// Route::get('songs/filter', [SongController::class, 'filter'])
//     ->name('songs.filter');

Route::resource('songs', SongController::class)
    ->middleware(['auth'])
    ->only(['create', 'store', 'edit', 'update', 'destroy']);
    
Route::get('songs/random', [SongController::class, 'random'])
        ->name('songs.random');
        
Route::resource('songs', SongController::class)
    ->only(['index', 'show']);

Route::resource('artists', ArtistController::class);

Route::resource('members', MemberController::class);

Route::resource('songs.likes', LikeController::class);

Route::resource('artists.follows', FollowController::class);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


// Route::get('songs/category/{cateId}', [SongController::class, 'searchCategory']);
// Route::get('songs/prefecture/{preId}', [SongController::class, 'searchPrefecture']);
