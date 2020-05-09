<?php

declare(strict_types=1);

namespace Yu\Price;

return [
    'admin' => [
        'table_manager' => [
            'currency' => [
                'columns' => [
                    [
                        'label' => 'Валюта',
                        'key' => 'name',
                    ],
                    [
                        'label' => 'Код',
                        'key' => 'code',
                    ],
                    [
                        'label' => 'Единица',
                        'key' => 'unit',
                    ],
                    [
                        'label' => 'Курс',
                        'key' => 'course',
                    ],
                    [
                        'label' => 'Сортировка',
                        'key' => 'sort',
                    ],
                ],
            ],
        ],
    ],
];
