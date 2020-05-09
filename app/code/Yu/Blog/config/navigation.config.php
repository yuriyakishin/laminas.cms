<?php

declare(strict_types=1);

namespace Yu\Content;

return [
    'navigation' => [
        'admin' => [
            'blog' =>
            [
                'label' => 'Публикации',
                'uri' => '#',
                'class' => 'fa-copy',
                'order' => 400,
                'pages' => [
                    [
                        'label' => 'Записи',
                        'route' => 'admin/post',
                        'pages' => [
                            [
                                'label' => 'Редактировать',
                                'route' => 'admin/post/edit',
                            ],
                        ],
                    ],
                    [
                        'label' => 'Рубрики',
                        'route' => 'admin/blog',
                        'pages' => [
                            [
                                'label' => 'Редактировать',
                                'route' => 'admin/blog/edit',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];