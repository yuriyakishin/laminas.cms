<?php

declare(strict_types=1);

namespace Yu\RealtyRentLand;

return [
    'navigation' => [
        'admin' => [
            'realty-rent' =>
                [
                    'pages' => [
                        'land' => [
                            'label' => 'Земля',
                            'route' => 'admin/realty-rent-land',
                            'pages' => [
                                [
                                    'label' => 'Редактировать',
                                    'route' => 'admin/realty-rent-land/edit',
                                ],
                            ],
                        ],
                    ],
                ],
        ],
    ],
];