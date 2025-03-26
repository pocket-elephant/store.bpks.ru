<?php

namespace App\Data;

use App\Models\Product;
use Spatie\LaravelData\Data;

class CartItemUpdateData extends Data
{
    public function __construct(
        public string $uuid,
        public int $quantity = 1,
    ) {}

    public function product(): Product
    {
        return Product::query()->where([
            'uuid' => $this->uuid,
        ])->first();
    }
}
