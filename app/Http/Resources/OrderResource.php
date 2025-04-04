<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->resource->uuid,
            'client' => $this->resource->client,
            'items' => OrderItemResource::collection(
                $this->resource->items
            ),
            'delivery' => [
                'type' => 'selfPickup',
                'data' => null,
            ],
        ];
    }
}
