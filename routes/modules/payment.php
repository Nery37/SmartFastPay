<?php

declare(strict_types=1);

use App\Http\Controllers\Api\PaymentsController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'payment'], function () {
    Route::get('', [PaymentsController::class, 'index'])->name('payment-list');
    Route::get('{id}', [PaymentsController::class, 'show'])->name('payment-show');
    Route::post('', [PaymentsController::class, 'storePayment'])->name('payment-store');
});
