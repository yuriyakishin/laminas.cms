<?php

declare(strict_types=1);

namespace Yu\Realty;

return [
    'navigation' => [
        'admin' => [
            'realty-sale' =>
            [
                'label' => 'Продажа',
                'uri' => '#',
                'class' => 'fa-dollar-sign',
                'order' => 100,
                'pages' => [
                ],
            ],
            'realty-rent' =>
                [
                    'label' => 'Аренда',
                    'uri' => '#',
                    'class' => 'fa-clock',
                    'order' => 200,
                    'pages' => [
                    ],
                ],
            'company' =>
                [
                    'label' => 'Компания',
                    'uri' => '#',
                    'class' => 'fa-briefcase',
                    'order' => 300,
                    'pages' => [
                        'agent' => [
                            'label' => 'Агенты',
                            'order' => 100,
                            'route' => 'admin/agent',
                            'pages' => [
                                [
                                    'label' => 'Редактировать',
                                    'route' => 'admin/agent/edit',
                                ],
                            ],
                        ],
                    ],
                ],
        ],
    ],
];