<?php

declare(strict_types=1);

namespace Yu\Price;

return [
    'navigation' => [
        'admin' => [
            'eav' =>
                [
                    'pages' => [
                        [
                            'label' => 'Валюты',
                            'route' => 'admin/currency',
                            'order' => 900,
                            'pages' => [
                                [
                                    'label' => 'Редактировать',
                                    'route' => 'admin/currency/edit',
                                ],
                            ],
                        ],
                    ],
                ],
        ],
    ],
];