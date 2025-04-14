<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\Validation\Digits;
use Spatie\LaravelData\Attributes\Validation\Numeric;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class PaymentDetailsData extends Data
{
    public function __construct(
        #[Numeric, Digits(20)]
        public string $bankAccountNumber,
        public array $bank,
    ) {}

    public static function rules(ValidationContext $context): array
    {
        return [
            'bank.data.bic' => 'required',
        ];
    }
}
