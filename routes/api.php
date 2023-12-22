<?php

use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\EjunkieController;
use App\Http\Controllers\StripeController;
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

Route::post('/submission', [SubmissionController::class, 'submit'])->name('submit.submission')->middleware(['web']);

Route::get('/ejunkie/all', [EjunkieController::class, 'getAllFromEjunkie']);

Route::get('/ejunkie/{productId}', [EjunkieController::class, 'getProductByProductId']);

Route::get('/stripe/webhook', [StripeController::class, 'hitWebhook']);
