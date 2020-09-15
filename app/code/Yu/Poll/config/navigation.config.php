<?php

declare(strict_types=1);

namespace Yu\Poll;

return [
    'navigation' => [
        'admin' => [
            'poll' =>
            [
                'label' => 'Опросы',
                'uri' => '#',
                'class' => 'fa-chart-line',
                'order' => 800,
                'pages' => [
                    [
                        'label' => 'Опросы',
                        'route' => 'admin/poll',
                        'pages' => [
                            [
                                'label' => 'Редактировать',
                                'route' => 'admin/poll/edit',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];