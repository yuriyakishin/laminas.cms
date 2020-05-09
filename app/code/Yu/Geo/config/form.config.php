<?php

declare(strict_types=1);

namespace Yu\Geo;

use Laminas\Form\Element;

return [
    'admin' => [
        'form_manager' => [
            'fieldsets' => [
                /*
                'map' => [
                    'elements' => [
                    ],
                    'options' => [
                        'template' => 'admin/geo/map',
                    ],
                ],
                */
                'geo' => [
                    'elements' => [
                        'address' => [
                            'type' => Element\Text::class,
                            'name' => 'address',
                            'lang' => true,
                            'options' => [
                                'label' => 'Адрес',
                            ],
                            'attributes' => [
                                'required' => false,
                            ],
                        ],
                        'mark' => [
                            'type' => Element\Text::class,
                            'name' => 'mark',
                            'lang' => true,
                            'options' => [
                                'label' => 'Ориентир',
                            ],
                            'attributes' => [
                                'required' => false,
                            ],
                        ],
                        'lat' => [
                            'type' => Element\Text::class,
                            'name' => 'lat',
                            'options' => [
                                'label' => 'Широта',
                            ],
                            'attributes' => [
                                'required' => false,
                            ],
                        ],
                        'lng' => [
                            'type' => Element\Text::class,
                            'name' => 'lng',
                            'options' => [
                                'label' => 'Долгота',
                            ],
                            'attributes' => [
                                'required' => false,
                            ],
                        ],
                    ],
                    'options' => [
                        'template' => 'admin/geo/map',
                    ],
                ],
            ],
        ],
    ],
];
