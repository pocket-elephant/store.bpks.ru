<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ShowCategory;
use App\Http\Controllers\ShowHomepage;
use Illuminate\Support\Facades\Route;

Route::get('/', ShowHomepage::class)
    ->name('home');

Route::get('category/{category:slug}', ShowCategory::class)
    ->name('categories.show');

Route::prefix('cart')->name('cart.')->group(function () {

    Route::get('/', [CartController::class, 'showCart'])
        ->name('show');

    Route::post('items', [CartController::class, 'updateItem'])
        ->name('addItem');

    Route::delete('items', [CartController::class, 'deleteItem'])
        ->name('deleteItem');

});
