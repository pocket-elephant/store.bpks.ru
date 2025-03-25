<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class SearchData extends Data
{
    public function __construct(
        public string $query,
    ) {}
}
