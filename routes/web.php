<?php

use App\Http\Controllers\PublisherController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::resource('/about-us', TeamController::class);

Route::get('/store/store-{slug}', [StoreController::class, 'creatorStore']);

Route::get('/store/other-publishers/store-{slug}', [StoreController::class, 'otherCreators']);

Route::resource('/store', StoreController::class);

Route::resource('/publishers', PublisherController::class);

Route::get('/brc-newsletter', function() {
    return view('brc-newsletter');
});
