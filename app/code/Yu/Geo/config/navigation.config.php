<?php

declare(strict_types=1);

namespace Yu\RealtySaleFlat;

return [
    'navigation' => [
        'admin' => [
            'eav' =>
                [
                    'pages' => [
                        [
                            'label' => 'Районы города',
                            'route' => 'admin/eav-value-option-district',
                            'order' => 100,
                            'pages' => [
                                [
                                    'label' => 'Редактировать',
                                    'route' => 'admin/eav-value-option-district/edit',
                                ],
                            ],
                        ],
                    ],
                ],
        ],
    ],
];