<?php

namespace App\Enums;

enum ClientType: string
{
    case Individual = 'individual';
    case Legal = 'legal';

    public static function labels(): array
    {
        return [
            self::Individual->value => 'Физическое лицо',
            self::Legal->value => 'Юридическое лицо',
        ];
    }
}
