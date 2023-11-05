<?php

use App\Http\Controllers\StoreController;
use App\Http\Controllers\SubmissionController;
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

Route::get('/store/universe/{universe_slug}/{slug}', [StoreController::class, 'seriesStore']);

Route::get('/store/universe/{slug}', [StoreController::class, 'universeStore']);

Route::resource('/store', StoreController::class);

Route::get('/brc-newsletter', function () {
    return view('brc-newsletter');
});

Route::get('/ejunkie-test', [StoreController::class, 'getAllFromEjunkie']);

Route::get('/ejunkie-test/{productId}', [StoreController::class, 'getProductByProductId']);

Route::get('/submit-your-book', [SubmissionController::class, 'index']);
