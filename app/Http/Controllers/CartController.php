<?php

namespace App\Http\Controllers;

use App\Data\CartItemDeleteData;
use App\Data\CartItemUpdateData;
use App\Models\Product;
use App\Repositories\OrderRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class CartController extends Controller
{
    protected OrderRepository $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function updateItem(CartItemUpdateData $updateData): RedirectResponse
    {
        $this->repository->updateItem($updateData);
        return Redirect::route('cart.show');
    }

    public function deleteItem(CartItemDeleteData $deleteData)
    {
        $order = $this->repository->currentOrder();

        $order->items()->where([
            'uuid' => $deleteData->uuid,
        ])->delete();

        return Redirect::route('cart.show');
    }

    public function showCart(): Response
    {
        $order = $this->repository->currentOrder();

        return Inertia::render('Cart', [
            'order' => $order,
        ]);
    }
}
