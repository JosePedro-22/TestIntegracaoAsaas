<?php

use App\Http\Controllers\API\AsaasPaymentController;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user/create', [UserController::class, 'createUser']);
Route::get('/login', [AuthController::class, 'login']);
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('customers', CustomerController::class);

    Route::prefix('payments')->group(function () {
        Route::post('/', [AsaasPaymentController::class, 'createPayment']);
        Route::get('/customer/{customerId}', [AsaasPaymentController::class, 'listCustomerPayments']);
        Route::delete('/{id}', [AsaasPaymentController::class, 'cancelPayment']);
        Route::get('/{id}/pix', [AsaasPaymentController::class, 'getPixQrCode']);
    });
});
