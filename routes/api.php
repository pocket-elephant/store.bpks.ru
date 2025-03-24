<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('orders', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');

    Route::get('orders/{order}', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');
});
