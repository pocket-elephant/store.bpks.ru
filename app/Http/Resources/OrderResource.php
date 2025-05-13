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
            'state' => $this->resource->state,
            'created_at' => $this->resource->created_at,
            'client' => $this->resource->client,
            'items' => OrderItemResource::collection(
                $this->resource->items
            ),
            'delivery' => $this->resource->delivery,
            'total' => $this->resource->total,
        ];
    }
}
