<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->resource->name,
            'stock' => $this->resource->stock,
            'unit' => $this->resource->okei->conventionalNationalView,
            'unitData' => OkeiResource::make(
                $this->resource->okei
            ),
            'price' => $this->resource->price,
            'supplierData' => $this->resource->supplier_data,
            'url' => $this->resource->url,
        ];
    }
}
