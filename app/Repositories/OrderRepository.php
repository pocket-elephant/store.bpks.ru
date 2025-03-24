<?php

namespace App\Repositories;

use App\Data\CartItemUpdateData;
use App\Models\Order;
use Illuminate\Support\Facades\Session;

class OrderRepository
{
    public function currentOrder(): ?Order
    {
        return Order::query()
            ->with('items.product')
            ->latest('id')
            ->where([
                'session_id' => Session::id(),
            ])
            ->first();
    }

    public function getOrCreateOrder(): Order
    {
        return Order::query()
            ->with('items')
            ->latest('id')
            ->firstOrCreate([
                'session_id' => Session::id(),
            ]);
    }

    public function updateItem(CartItemUpdateData $updateData)
    {
        $order = $this->getOrCreateOrder();

        return $order->items()->updateOrCreate([
            'product_id' => $updateData->product()->id,
        ], [
            'quantity' => $updateData->quantity,
        ]);
    }
}
