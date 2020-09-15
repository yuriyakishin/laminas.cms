<?php

declare(strict_types=1);

namespace Yu\Gallery;

return [
    'admin' => [
        'table_manager' => [
            'gallery' => [
                'columns' => [
                    [
                        'label' => 'Фото',
                        'key' => 'image',
                        'source' => [
                            'view_helper' => \Yu\Media\View\Helper\PreviewHelper::class,
                            'options' => function ($data) {
                                return array('path' => 'gallery', 'pathId' => $data->getId());
                            }
                        ],
                    ],
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
        ],
    ],
];
