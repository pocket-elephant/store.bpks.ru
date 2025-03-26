<?php

namespace App\Data;

use App\Enums\ClientType;
use Spatie\LaravelData\Data;

class ClientData extends Data
{
    public function __construct(
        public ContactData $contact,
        public ClientType $type,
        public ?array $data = null
    ) {}
}
