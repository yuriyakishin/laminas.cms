<?php

declare(strict_types=1);

namespace Yu\RealtyRentFlat;

return [
    'navigation' => [
        'admin' => [
            'realty-rent' =>
                [
                    'pages' => [
                        'flat' => [
                            'label' => 'Квартиры',
                            'route' => 'admin/realty-rent-flat',
                            'pages' => [
                                [
                                    'label' => 'Редактировать',
                                    'route' => 'admin/realty-rent-flat/edit',
                                ],
                            ],
                        ],
                    ],
                ],
            'eav' =>
                [
                    'pages' => [
                        [
                            'label' => 'Класс аренды',
                            'route' => 'admin/eav-value-option-class',
                            'order' => 500,
                            'pages' => [
                                [
                                    'label' => 'Редактировать',
                                    'route' => 'admin/eav-value-option-class/edit',
                                ],
                            ],
                        ],
                    ],
                ],
        ],
    ],
];