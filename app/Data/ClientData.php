<?php

namespace App\Data;

use App\Enums\ClientType;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class ClientData extends Data
{
    public function __construct(
        public ContactData $contact,
        public ClientType $type,
        public ?PaymentDetailsData $paymentDetails = null,
        public ?array $data = null
    ) {}

    public static function rules(ValidationContext $context): array
    {
        return [
            'data.data.inn' => 'required_if:client.type,' . ClientType::Legal->value,
            'paymentDetails' => 'required_if:client.type,' . ClientType::Legal->value,
        ];
    }
}
