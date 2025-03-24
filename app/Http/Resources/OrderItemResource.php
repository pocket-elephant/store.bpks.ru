<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
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
            'product' => ProductResource::make(
                $this->resource->product
            ),
            'total' => round($this->resource->product->price * $this->resource->quantity, 2),
            'quantity' => $this->resource->quantity,
        ];
    }
}
