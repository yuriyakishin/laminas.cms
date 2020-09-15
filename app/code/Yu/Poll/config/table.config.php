<?php

declare(strict_types=1);

namespace Yu\Poll;

return [
    'admin' => [
        'table_manager' => [
            'poll' => [
                'columns' => [
                    [
                        'label' => 'Опрос',
                        'key' => 'value',
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
