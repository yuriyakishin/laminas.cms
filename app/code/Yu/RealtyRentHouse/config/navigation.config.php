<?php

declare(strict_types=1);

namespace Yu\RealtyRentHouse;

return [
    'navigation' => [
        'admin' => [
            'realty-rent' =>
                [
                    'pages' => [
                        'house' => [
                            'label' => 'Дома',
                            'route' => 'admin/realty-rent-house',
                            'pages' => [
                                [
                                    'label' => 'Редактировать',
                                    'route' => 'admin/realty-rent-house/edit',
                                ],
                            ],
                        ],
                    ],
                ],
        ],
    ],
];