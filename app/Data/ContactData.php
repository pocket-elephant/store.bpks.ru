<?php

namespace App\Data;

use App\PhoneCastAndTransformer;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\WithCastAndTransformer;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class ContactData extends Data
{
    public function __construct(

        public string $name,

        #[Email()]
        public string $email,

        #[WithCastAndTransformer(PhoneCastAndTransformer::class)]
        public string $phone,
    ) {}

    public static function rules(ValidationContext $context): array
    {
        return  [
            'phone' => 'phone:RU',
            'email' => 'email',
        ];
    }
}
