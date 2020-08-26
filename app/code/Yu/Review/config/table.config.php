<?php

declare(strict_types=1);

namespace Yu\Review;

return [
    'admin' => [
        'table_manager' => [
            'review' => [
                'columns' => [
                    [
                        'label' => 'Имя',
                        'key' => 'name',
                    ],
                    [
                        'label' => 'Содержимое',
                        'key' => 'content',
                    ],
                    /*
                    [
                        'label' => 'Дата',
                        'key' => 'date',
                        'filter' => \Yu\Core\Filter\DateTimeToString::class,
                    ],
                    */
                    [
                        'label' => 'ID',
                        'key' => 'id',
                    ],
                    [
                        'label' => 'Сортировка',
                        'key' => 'sort',
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
