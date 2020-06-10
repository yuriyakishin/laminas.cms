<?php

declare(strict_types=1);

namespace Yu\RealtySaleLand;

return [
    'navigation' => [
        'admin' => [
            'realty-sale' =>
                [
                    'pages' => [
                        'land' => [
                            'label' => 'Земля',
                            'route' => 'admin/realty-sale-land',
                            'pages' => [
                                [
                                    'label' => 'Редактировать',
                                    'route' => 'admin/realty-sale-land/edit',
                                ],
                            ],
                        ],
                    ],
                ],
        ],
    ],
];