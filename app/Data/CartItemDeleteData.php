<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class CartItemDeleteData extends Data
{
    public function __construct(
        public string $uuid,
    ) {}
}
