<?php

declare(strict_types=1);

namespace Yu\Gallery;

return [
    'navigation' => [
        'admin' => [
            [
                'label' => 'Галереи',
                'uri' => '#',
                'class' => 'fa-image',
                'order' => 900,
                'pages' => [
                    [
                        'label' => 'Галереи',
                        'route' => 'admin/gallery',
                        'pages' => [
                            [
                                'label' => 'Редактор',
                                'route' => 'admin/gallery/edit',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];