<?php

declare(strict_types=1);

namespace Yu\RealtySaleHouse;

return [
    'navigation' => [
        'admin' => [
            'realty-sale' =>
                [
                    'pages' => [
                        'house' => [
                            'label' => 'Дома',
                            'route' => 'admin/realty-sale-house',
                            'pages' => [
                                [
                                    'label' => 'Редактировать',
                                    'route' => 'admin/realty-sale-house/edit',
                                ],
                            ],
                        ],
                    ],
                ],
        ],
    ],
];