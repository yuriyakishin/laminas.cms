<?php

declare(strict_types=1);

namespace Yu\Board;

return [
    'navigation' => [
        'admin' => [
            'board' =>
            [
                'label' => 'Доска объявлений',
                'uri' => '#',
                'class' => 'fa-edit',
                'order' => 500,
                'pages' => [
                    [
                        'label' => 'Объявления',
                        'route' => 'admin/board',
                    ],
                    [
                        'label' => 'Города',
                        'route' => 'admin/board-city',
                        'pages' => [
                            [
                                'label' => 'Редактировать',
                                'route' => 'admin/board-city/edit',
                            ],
                        ],
                    ],
                    [
                        'label' => 'Разделы',
                        'route' => 'admin/board-type',
                        'pages' => [
                            [
                                'label' => 'Редактировать',
                                'route' => 'admin/board-type/edit',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];