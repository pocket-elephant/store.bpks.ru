<?php

namespace App;

use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;
use Spatie\LaravelData\Support\Transformation\TransformationContext;
use Spatie\LaravelData\Transformers\Transformer;

class PhoneCastAndTransformer implements Transformer, Cast
{
    public function transform(DataProperty $property, mixed $value, TransformationContext $context): string
    {
        return phone($value, 'RU')
            ->formatE164();
    }

    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): string
    {
        return phone($value, 'RU')
            ->formatE164();
    }
}
