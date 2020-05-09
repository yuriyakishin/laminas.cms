<?php

declare(strict_types=1);

namespace Yu\Content;

return [
    'admin' => [
        'table_manager' => [
            'blog-rubric' => [
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
                        'label' => 'Сортировка',
                        'key' => 'sort',
                    ],
                    [
                        'label' => 'Активность',
                        'key' => 'active',
                    ],
                ],
            ],
            'blog-post' => [
                'columns' => [
                    [
                        'label' => '',
                        'key' => 'image',
                        'source' => [
                            'view_helper' => \Yu\Media\View\Helper\PreviewHelper::class,
                            'options' => function ($data) {
                                return array('path' => 'post', 'pathId' => $data->getId());
                            }
                        ],
                    ],
                    [
                        'label' => 'Наименование',
                        'key' => 'title',
                    ],
                    [
                        'label' => 'Дата',
                        'key' => 'date',
                        'filter' => \Yu\Core\Filter\DateTimeToString::class,
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
                        'label' => 'Сортировка',
                        'key' => 'sort',
                    ],
                    [
                        'label' => 'Рубрика',
                        'key' => 'rubric_id',
                        'target_class' => \Yu\Blog\Entity\Rubric::class,
                        'property' => 'title',
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
