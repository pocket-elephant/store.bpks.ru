<?php

namespace App\Http\Middleware;

use App\Enums\ClientType;
use App\Enums\DeliveryType;
use App\Http\Resources\OrderResource;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        /** @var OrderRepository $orderRepository */
        $orderRepository = app(OrderRepository::class);
        $currentOrder = $orderRepository->currentOrder();

        return array_merge(parent::share($request), [
            'cart' => [
                'order' => $currentOrder
                    ? OrderResource::make($currentOrder)
                    : null,
            ],
            'defines' => [
                'clientTypes' => [
                    'options' => ClientType::labels(),
                    'default' => ClientType::Individual,
                ],
                'deliveryTypes' => [
                    'options' => DeliveryType::labels(),
                    'default' => DeliveryType::SelfPickup,
                ],
                'warehouses' => [
                    [
                        'code' => '000000505',
                        'name' => 'Москва Энтузиастов',
                        'address' => 'Москва, 2-я улица Энтузиастов, 3',
                        'number' => 401,
                        'city' => 'Москва'
                    ],
                    [
                        'code' => '000000346',
                        'name' => 'Щелково',
                        'address' => 'Московская область, Щёлково, Рабочая улица, 17',
                        'number' => 1501,
                        'city' => 'Московская область'
                    ],
                    [
                        'code' => '000000334',
                        'name' => 'Новополье',
                        'address' => 'Санкт-Петербург, Петродворцовый район, посёлок Стрельна, улица Нижняя Колония, 53А',
                        'number' => 301,
                        'city' => 'Санкт-Петербург'
                    ],
                    [
                        'code' => '000000491',
                        'name' => 'Короленко',
                        'address' => 'Санкт-Петербург, улица Короленко, 7',
                        'number' => 201,
                        'city' => 'Санкт-Петербург'
                    ]
                ],
            ],
        ]);
    }
}
