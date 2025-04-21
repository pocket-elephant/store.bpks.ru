<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SyncOrderResult extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'result' => $this->resource['result'],
            'data' => $this->resource['data'],
            'order' => OrderResource::make($this->resource['order']),
        ];
    }
}
