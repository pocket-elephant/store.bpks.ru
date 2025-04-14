<?php

namespace App\Data;

use App\Enums\DeliveryType;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class DeliveryData extends Data
{
    public function __construct(
        public DeliveryType $type,
        public ?array $data,
    ) {}

    public static function rules(ValidationContext $context): array
    {
        return [
            'data.value' => 'required_if:delivery.type,' . DeliveryType::ToAddress->value,
        ];
    }
}
