<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShowCategory;
use App\Http\Controllers\ShowHomepage;
use App\Http\Controllers\ShowOrder;
use App\Http\Controllers\ShowProduct;
use App\Http\Controllers\ShowYmlFeed;
use Illuminate\Support\Facades\Route;

Route::get('/', ShowHomepage::class)
    ->name('home');

Route::get('{category:slug}_c', ShowCategory::class)
    ->name('categories.show');

Route::get('{product:slug}_p', ShowProduct::class)
    ->name('products.show');


Route::prefix('cart')->name('cart.')->group(function () {

    Route::get('/', [CartController::class, 'showCart'])
        ->name('show');

    Route::post('items', [CartController::class, 'updateItem'])
        ->name('addItem');

    Route::delete('items', [CartController::class, 'deleteItem'])
        ->name('deleteItem');

    Route::post('checkout', [CartController::class, 'checkout'])
        ->name('checkout');

});

Route::get('order/{order:uuid}/complete', ShowOrder::class)
    ->name('orders.show');


Route::get('search', [SearchController::class, 'search'])
    ->name('search');


Route::get('yml/feed.yml', ShowYmlFeed::class);
