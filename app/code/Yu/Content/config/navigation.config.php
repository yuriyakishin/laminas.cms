<?php

declare(strict_types=1);

namespace Yu\Content;

return [
    'navigation' => [
        'admin' => [
            [
                'label' => 'Контент',
                'uri' => '#',
                'class' => 'fa-book',
                'order' => 300,
                'pages' => [
                    [
                        'label' => 'Cтраницы',
                        'route' => 'admin/page',
                        'pages' => [
                            [
                                'label' => 'Редактор',
                                'route' => 'admin/page/edit',
                            ],
                        ],
                    ],
                    [
                        'label' => 'Блоки',
                        'route' => 'admin/block',
                        'pages' => [
                            [
                                'label' => 'Редактор',
                                'route' => 'admin/block/edit',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];