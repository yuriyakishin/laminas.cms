<?php

declare(strict_types=1);

namespace Yu\RealtySaleFlat;

return [
    'admin' => [
        'table_manager' => [
            'realty-sale-flat' => [
                'columns' => [
                    [
                        'label' => 'Код',
                        'key' => 'code',
                    ],
                    [
                        'label' => 'Фото',
                        'key' => 'image',
                        'source' => [
                            'view_helper' => \Yu\Media\View\Helper\PreviewHelper::class,
                            'options' => function ($data) {
                                return array('path' => 'realty', 'pathId' => $data['id']);
                            }
                        ],
                    ],
                    [
                        'label' => 'Кол. комнат',
                        'key' => 'rooms',
                    ],
                    [
                        'label' => 'Район',
                        'key' => 'district',
                        'source' => [
                            'view_helper' => \Yu\Eav\View\Helper\ViewOptionHelper::class,
                            'options' => function ($data) {
                                return array('id' => $data['district']);
                            }
                        ],
                    ],
                    [
                        'label' => 'Адрес',
                        'key' => 'address',
                    ],
                    [
                        'label' => 'Цена',
                        'key' => 'price',
                    ],
                    [
                        'label' => 'Валюта',
                        'key' => 'currency',
                        'target_class' => \Yu\Price\Entity\Currency::class,
                        'findBy' => 'id',
                        'property' => 'name',
                    ],
                    [
                        'label' => 'Проект',
                        'key' => 'project',
                        'source' => [
                            'view_helper' => \Yu\Eav\View\Helper\ViewOptionHelper::class,
                            'options' => function ($data) {
                                return array('id' => $data['project']);
                            }
                        ],
                    ],
                    [
                        'label' => 'ID',
                        'key' => 'id',
                    ],
                    [
                        'label' => 'Активность',
                        'key' => 'active',
                    ],
                    [
                        'label' => 'На главной',
                        'key' => 'main',
                    ],
                ],
                'options' => [
                    'route' => 'admin/realty-sale-flat',
                ]
            ],
        ],
    ],
];