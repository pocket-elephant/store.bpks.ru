<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('orders', function (Request $request) {
        return \App\Http\Resources\OrderResource::collection(
            \App\Models\Order::query()
                ->where('state', \App\Enums\OrderState::Completed)
                ->latest()
                ->paginate(50)
        );
    });

    Route::get('orders/{order:uuid}', function (\App\Models\Order $order) {
        return \App\Http\Resources\OrderResource::make($order);
    });
});
