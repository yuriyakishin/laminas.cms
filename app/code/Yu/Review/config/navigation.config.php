<?php

declare(strict_types=1);

namespace Yu\Review;

return [
    'navigation' => [
        'admin' => [
            'company' =>
            [
                'pages' => [
                    [
                        'label' => 'Отзывы',
                        'route' => 'admin/review',
                        'order' => 200,
                        'pages' => [
                            [
                                'label' => 'Редактировать',
                                'route' => 'admin/review/edit',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];