<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentStatusController;
use App\Http\Controllers\PayheroPaymentController;

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

Route::post('/stk/callback', [PayheroPaymentController::class, 'stkCallback'])->name('stk.callback');

// payhero payment check
Route::get('/check-payment-status', [PaymentStatusController::class, 'check']);
