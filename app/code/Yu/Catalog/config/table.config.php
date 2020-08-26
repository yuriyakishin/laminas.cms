<?php

declare(strict_types=1);

namespace Yu\Catalog;

return [
    'admin' => [
        'table_manager' => [
            'catalog' => [
                'columns' => [
                    [
                        'label' => 'Рубрика',
                        'key' => 'categoryId',
                        'source' => [
                            'view_helper' => \Yu\Eav\View\Helper\ViewOptionHelper::class,
                            'options' => function ($data) {
                                return array('id' => $data['category_id']);
                            }
                        ],
                    ],
                    [
                        'label' => 'Заголовок',
                        'key' => 'name',
                    ],
                    [
                        'label' => 'Содержимое',
                        'key' => 'content',
                    ],
                    [
                        'label' => 'Телефон',
                        'key' => 'phone',
                    ],
                    [
                        'label' => 'Email',
                        'key' => 'email',
                    ],
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
