<?php

namespace App\Enums;

enum OrderState: string
{
    case Created = 'created';
    case Completed = 'completed';
    case Rejected = 'rejected';
    case Expired = 'expired';
}
