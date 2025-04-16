<?php

use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\SubmissionController;
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

Route::get('/store/series/{slug}', [StoreController::class, 'series'])->name('series');
Route::get('/store/{slug}', [StoreController::class, 'brcOrCommunity'])->name('brcOrCommunity');
Route::resource('/store', StoreController::class);

Route::get('/brc-newsletter', [NewsletterController::class, 'index'])->name('newsletter');

Route::get('/submit-your-book', [SubmissionController::class, 'index']);

Route::get('/payment-success', [StripeController::class, 'success'])->name('payment_success');
Route::get('/payment-failure', [StripeController::class, 'failure'])->name('payment_failure');
