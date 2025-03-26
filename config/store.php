<?php

return [
    'orders' => [
        [
            'uuid' => '4298ad22-2804-45d4-b940-eeff4a886b26',
            'client' => [
                'contact' => [
                    'name' => 'Иванов Иван Иванович',
                    'phone' => '+79999999999',
                    'email' => 'clinet@example.com',
                ],
                'type' => 'legal',
                'data' => [
                    "value" => "ООО РОГА И КОПЫТА",
                    "kpp" => "504201001",
                    "name" => [
                        "full_with_opf" => "ОБЩЕСТВО С ОГРАНИЧЕННОЙ ОТВЕТСТВЕННОСТЬЮ \"РОГА И КОПЫТА\"",
                        "short_with_opf" => "ООО \"РОГА И КОПЫТА\"",
                        "latin" => null,
                        "full" => "РОГА И КОПЫТА",
                        "short" => "РОГА И КОПЫТА",
                    ],
                    "inn" => "5042162595",
                    "ogrn" => "1235000084934",
                    "okpo" => "56322780",
                    "okato"=> "46428000279",
                    "oktmo" => "46728000379",
                    "okogu" => "4210014",
                    "okfs" => "16",
                ],
            ],
            'items' => [
                [
                    'uuid' => '8f31515b-d452-4797-9eb5-d4e1af0b2a86',
                    'name' => 'Кабель ВВГнг(А)-LS 3х2.5 ОК (N PE) 0.66кВ (м) Энергокабель ЭИЗМ1001027',
                    'unit' => 'м',
                    'quantity' => 30,
                    'price' => 131.40,
                    'cost' => 30 * 131.40,
                    'currency' => 'RUB',
                    'supplierCode' => 'ЭИЗМ1001027',
                    'supplier' => [
                        'uuid' => 'aeffc890-b19b-4e24-aaa3-2f504e776976',
                        'name' => 'Русский свет',
                    ],
                ],
                [
                    'uuid' => '4e9576f2-38c3-4053-a24b-525fd7e0028a',
                    'name' => 'Провод СИП-4 2х16 0.6/1кВ (м) Балткабель 51006',
                    'unit' => 'м',
                    'quantity' => 140,
                    'price' => 65.40,
                    'cost' => 140 * 65.40,
                    'currency' => 'RUB',
                    'supplierCode' => '51006',
                    'supplier' => [
                        'uuid' => 'aeffc890-b19b-4e24-aaa3-2f504e776976',
                        'name' => 'Русский свет',
                    ],
                ],
            ],
            'delivery' => [
                'type' => 'selfPickup',
                'data' => null,
            ],
        ],

        [
            'uuid' => 'da4cedce-217b-41fa-a11c-9981a9343a85',
            'client' => [
                'contact' => [
                    'name' => 'Петров Петр Петрович',
                    'phone' => '+79000000000',
                    'email' => 'clinet2@example.com',
                ],
                'type' => 'individual',
                'data' => null,
            ],
            'items' => [
                [
                    'uuid' => 'bf53b7a5-c171-48c5-9bb0-0d79195338bf',
                    'name' => 'Кабель ВВГ-Пнг(А)-LS 2х2.5 ОК (N) 0.66кВ (бухта) (м) РЭК-PRYSMIAN 1602050101',
                    'unit' => 'м',
                    'quantity' => 20,
                    'price' => 76.80,
                    'cost' => 20 * 76.80,
                    'currency' => 'RUB',
                    'supplierCode' => '1602050101',
                    'supplier' => [
                        'uuid' => 'aeffc890-b19b-4e24-aaa3-2f504e776976',
                        'name' => 'Русский свет',
                    ],
                ],
                [
                    'uuid' => '9fa06d87-eea1-4db9-8ec4-72d69a8aa8ff',
                    'name' => 'Кабель ТППэп 20х2х0.4 200В (м) Кольчугино 100000061312030001',
                    'unit' => 'м',
                    'quantity' => 100,
                    'price' => 138.96,
                    'cost' => 100 * 138.96,
                    'currency' => 'RUB',
                    'supplierCode' => '100000061312030001',
                    'supplier' => [
                        'uuid' => 'aeffc890-b19b-4e24-aaa3-2f504e776976',
                        'name' => 'Русский свет',
                    ],
                ],
            ],
            'delivery' => [
                'type' => 'selfPickup',
                'data' => null,
            ],
        ]
    ],
];
