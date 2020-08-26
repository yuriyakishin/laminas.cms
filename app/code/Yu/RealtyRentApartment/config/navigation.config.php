<?php

declare(strict_types=1);

namespace Yu\RealtyRentApartment;

return [
    'navigation' => [
        'admin' => [
            'realty-rent' => [
                'pages' => [
                    'apartment' => [
                        'label' => 'Посуточно',
                        'route' => 'admin/realty-rent-apartment',
                        'pages' => [
                            [
                                'label' => 'Редактировать',
                                'route' => 'admin/realty-rent-apartment/edit',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];