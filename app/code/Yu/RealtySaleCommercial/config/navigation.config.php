<?php

declare(strict_types=1);

namespace Yu\RealtySaleCommercial;

return [
    'navigation' => [
        'admin' => [
            'realty-sale' =>
                [
                    'pages' => [
                        'commercial' => [
                            'label' => 'Коммерческая',
                            'route' => 'admin/realty-sale-commercial',
                            'pages' => [
                                [
                                    'label' => 'Редактировать',
                                    'route' => 'admin/realty-sale-commercial/edit',
                                ],
                            ],
                        ],
                    ],
                ],
            'eav' =>
                [
                    'pages' => [
                        [
                            'label' => 'Коммерческая',
                            'route' => 'admin/eav-value-option-commercial',
                            'order' => 300,
                            'pages' => [
                                [
                                    'label' => 'Редактировать',
                                    'route' => 'admin/eav-value-option-commercial/edit',
                                ],
                            ],
                        ],
                    ],
                ],
        ],
    ],
];