<?php

use App\Http\Controllers\PublisherController;
use App\Http\Controllers\ProductController;
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

Route::get('/store/store-{slug}', [ProductController::class, 'creatorStore']);

Route::get('/store/other-publishers/store-{slug}', [ProductController::class, 'otherCreators']);

Route::resource('/store', ProductController::class);

Route::resource('/publishers', PublisherController::class);

Route::get('/brc-newsletter', function() {
    return view('brc-newsletter');
});

Route::get('/ejunkie-test', [ProductController::class, 'getAllFromEjunkie']);

Route::get('/ejunkie-test/{productId}', [ProductController::class, 'getProductByProductId']);
