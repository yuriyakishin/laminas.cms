<?php

declare(strict_types=1);

namespace Yu\Content;

return [
    'pages' => [
        'about' => [
            [
                'label' => 'Контент',
                'route' => '#',
                'class' => 'fa-file',
                'pages' => [
                    [
                        'label' => 'Cтраницы',
                        'route' => 'admin/page',
                    ],
                ],
            ],
        ],
    ],
    'admin' => [
        'table_manager' => [
            'pages' => [
                'columns' => [
                    [
                        'label' => 'Наименование',
                        'key' => 'title',
                    ],
                    [
                        'label' => 'Адрес URI',
                        'key' => 'identifier',
                    ],
                    [
                        'label' => 'ID',
                        'key' => 'id',
                    ],
                    [
                        'label' => 'Активность',
                        'key' => 'active',
                    ],
                ],
            ],
            'blocks' => [
                'columns' => [
                    [
                        'label' => 'Наименование',
                        'key' => 'title',
                    ],
                    [
                        'label' => 'Идентификатор',
                        'key' => 'identifier',
                    ],
                    [
                        'label' => 'ID',
                        'key' => 'id',
                    ],
                    [
                        'label' => 'Активность',
                        'key' => 'active',
                    ],
                ],
            ],
        ],
    ],
];
