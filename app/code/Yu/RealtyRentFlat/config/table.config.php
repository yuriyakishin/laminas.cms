<?php

declare(strict_types=1);

namespace Yu\RealtyRentFlat;

return [
    'admin' => [
        'table_manager' => [
            'realty-rent-flat' => [
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
                        'label' => 'Класс',
                        'key' => 'class',
                        'source' => [
                            'view_helper' => \Yu\Eav\View\Helper\ViewOptionHelper::class,
                            'options' => function ($data) {
                                return array('id' => $data['class']);
                            }
                        ],
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
                        'label' => 'ID',
                        'key' => 'id',
                    ],
                    [
                        'label' => 'Активность',
                        'key' => 'active',
                    ],
                ],
                'options' => [
                    'route' => 'admin/realty-rent-flat',
                ]
            ],
        ],
    ],
];