<?php

declare(strict_types=1);

namespace Yu\Board;

return [
    'admin' => [
        'table_manager' => [
            'board-city' => [
                'columns' => [
                    [
                        'label' => 'Наименование города',
                        'key' => 'name',
                    ],
                    [
                        'label' => 'Сортировка',
                        'key' => 'num',
                    ],
                ],
            ],
            'board-type' => [
                'columns' => [
                    [
                        'label' => 'Раздел объявлений',
                        'key' => 'name',
                    ],
                    [
                        'label' => 'Сортировка',
                        'key' => 'num',
                    ],
                ],
            ],
            'board' => [
                'columns' => [
                    [
                        'label' => 'Имя',
                        'key' => 'person',
                    ],
                    [
                        'label' => 'Дата',
                        'key' => 'date',
                        'filter' => \Yu\Core\Filter\DateUnixToString::class,
                    ],
                    [
                        'label' => 'Объявление',
                        'key' => 'message',
                    ],
                    [
                        'label' => 'Телефон',
                        'key' => 'phone',
                    ],
                    [
                        'label' => 'Город',
                        'key' => 'city',
                    ],
                    [
                        'label' => 'Раздел',
                        'key' => 'type',
                    ],
                    [
                        'label' => 'ID',
                        'key' => 'id',
                    ],
                    [
                        'label' => 'Активность',
                        'key' => 'view',
                    ],
                ],
            ],
        ],
    ],
];
