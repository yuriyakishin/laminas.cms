<?php

declare(strict_types=1);

namespace Yu\Content;

return [
    'admin' => [
        'table_manager' => [
            'agent' => [
                'columns' => [
                    [
                        'label' => 'Фото',
                        'key' => 'image',
                        'source' => [
                            'view_helper' => \Yu\Media\View\Helper\PreviewHelper::class,
                            'options' => function ($data) {
                                return array('path' => 'agent', 'pathId' => $data->getId());
                            }
                        ],
                    ],
                    [
                        'label' => 'ФИО',
                        'key' => 'name',
                    ],
                    [
                        'label' => 'Код',
                        'key' => 'code',
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
