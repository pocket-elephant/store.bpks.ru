<?php

namespace App\Data;

use App\Models\Application;
use Spatie\LaravelData\Attributes\FromAuthenticatedUser;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
class SyncOrderData extends Data
{
    public function __construct(

        #[FromAuthenticatedUser]
        public Application $application,

        public ?string $externalId = null,

    ) {}
}
