<?php

namespace App\Http\Controllers;

use App\Data\ApplicationData;
use App\Data\SyncOrderData;
use App\Enums\OrderState;
use App\Http\Resources\OrderResource;
use App\Http\Resources\SyncOrderResult;
use App\Models\Order;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OrdersController extends Controller
{
    public function listOfNew(ApplicationData $data): AnonymousResourceCollection
    {
        return OrderResource::collection(
            Order::query()
                ->where('state', OrderState::Completed)
                ->whereDoesntHave('applications', function ($query) use (&$data) {
                    return $query->where('application_id', $data->application->id);
                })
                ->latest()
                ->paginate(50)
        );
    }

    public function show(Order $order): OrderResource
    {
        return OrderResource::make($order);
    }

    public function sync(Order $order, SyncOrderData $data)
    {
        $result = $order->applications()->syncWithoutDetaching([
            $data->application->id, [
                'external_id' => $data->externalId,
            ],
        ]);

        return SyncOrderResult::make([
            'result' => $result,
            'data' => $data,
            'order' => $order,
        ]);

    }
}
