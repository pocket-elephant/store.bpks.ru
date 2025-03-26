<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use Inertia\Inertia;

class ShowOrder extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Order $order)
    {
        return Inertia::render('OrderComplete', [
            'order' => OrderResource::make($order),
        ]);
    }
}
