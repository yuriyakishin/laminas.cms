<?php

declare(strict_types=1);

namespace Yu\Content;

return [
    'admin' => [
        'table_manager' => [
            'agent' => [
                'columns' => [
                    [
                        'label' => 'ФИО',
                        'key' => 'name',
                    ],
                    [
                        'label' => 'Телефон 1',
                        'key' => 'phone1',
                    ],
                    [
                        'label' => 'Телефон 2',
                        'key' => 'phone2',
                    ],
                    [
                        'label' => 'Email',
                        'key' => 'email',
                    ],
                    [
                        'label' => 'Должность',
                        'key' => 'post',
                    ],
                ],
            ],
        ],
    ],
];
