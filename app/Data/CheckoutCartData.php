<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class CheckoutCartData extends Data
{
    public function __construct(
        public ClientData $client,
        public DeliveryData $delivery,
        public bool $acceptPrivacyPolicy,
    ) {}
}
