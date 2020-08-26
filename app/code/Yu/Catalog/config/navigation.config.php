<?php

declare(strict_types=1);

namespace Yu\Catalog;

return [
    'navigation' => [
        'admin' => [
            'catalog' =>
            [
                'label' => 'Купим/Снимем',
                'uri' => '#',
                'class' => 'fa-thumbtack',
                'order' => 700,
                'pages' => [
                    [
                        'label' => 'Объявления',
                        'route' => 'admin/catalog',
                        'pages' => [
                            [
                                'label' => 'Редактировать',
                                'route' => 'admin/catalog/edit',
                            ],
                        ],
                    ],
                    [
                        'label' => 'Рубрики',
                        'route' => 'admin/eav-value-option-catalog-category',
                        'pages' => [
                            [
                                'label' => 'Редактировать',
                                'route' => 'admin/eav-value-option-catalog-category/edit',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];