<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OkeiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'code' => $this->resource->code,
            'name' => $this->resource->name,
            'conventionalNationalView' => $this->resource->conventionalNationalView,
            'conventionalInternationalView' => $this->resource->conventionalInternationalView,
            'symbolNationalView' => $this->resource->symbolNationalView,
            'symbolInternationalView' => $this->resource->symbolInternationalView,
        ];
    }
}
