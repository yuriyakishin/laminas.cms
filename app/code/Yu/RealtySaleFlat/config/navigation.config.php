<?php

declare(strict_types=1);

namespace Yu\RealtySaleFlat;

return [
    'navigation' => [
        'admin' => [
            'realty-sale' =>
                [
                    'pages' => [
                        'flat' => [
                            'label' => 'Квартиры',
                            'route' => 'admin/realty-sale-flat',
                            'pages' => [
                                [
                                    'label' => 'Редактировать',
                                    'route' => 'admin/realty-sale-flat/edit',
                                ],
                            ],
                        ],
                    ],
                ],
            'eav' =>
                [
                    'pages' => [
                        [
                            'label' => 'Проекты домов',
                            'route' => 'admin/eav-value-option-project',
                            'order' => 200,
                            'pages' => [
                                [
                                    'label' => 'Редактировать',
                                    'route' => 'admin/eav-value-option-project/edit',
                                ],
                            ],
                        ],
                    ],
                ],
        ],
    ],
];