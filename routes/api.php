<?php

use App\Http\Controllers\OrdersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->name('api.')->group(function () {

    Route::prefix('orders')
        ->name('orders.')
        ->middleware('auth:sanctum')
        ->group(function () {
            Route::get('/', [OrdersController::class, 'listOfNew'])->name('listOfNew');
            Route::get('orders/{order:uuid}', [OrdersController::class, 'show'])->name('show');
            Route::post('orders/{order:uuid}/sync', [OrdersController::class, 'sync'])->name('sync');
        });
});
