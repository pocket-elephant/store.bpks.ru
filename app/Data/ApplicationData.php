<?php

namespace App\Data;

use App\Models\Application;
use Spatie\LaravelData\Attributes\FromAuthenticatedUser;
use Spatie\LaravelData\Data;

class ApplicationData extends Data
{
    public function __construct(
        #[FromAuthenticatedUser]
        public Application $application,
    ) {}
}
