<?php

namespace App\Enums;

enum DeliveryType: string
{
    case SelfPickup = 'selfPickup';
    case ToAddress = 'toAddress';

    public static function labels(): array
    {
        return [
            self::SelfPickup->value => 'Самовывоз из пункта выдачи',
            self::ToAddress->value => 'Доставка до адреса',
        ];
    }
}
