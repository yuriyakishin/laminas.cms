<?php

declare(strict_types=1);

namespace Yu\RealtyRentCommercial;

return [
    'navigation' => [
        'admin' => [
            'realty-rent' =>
                [
                    'pages' => [
                        'commercial' => [
                            'label' => 'Коммерческая',
                            'route' => 'admin/realty-rent-commercial',
                            'pages' => [
                                [
                                    'label' => 'Редактировать',
                                    'route' => 'admin/realty-rent-commercial/edit',
                                ],
                            ],
                        ],
                    ],
                ],
        ],
    ],
];