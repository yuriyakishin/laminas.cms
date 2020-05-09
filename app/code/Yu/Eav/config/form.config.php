<?php

declare(strict_types=1);

namespace Yu\Eav;

use Laminas\Form\Element;

return [
    'admin' => [
        'form_manager' => [
            'forms' => [
                // Forms
                'eav-value-option' => [
                    'lang' => true,
                    'tabs' => [
                        'main' => [
                            'label' => 'Справочник',
                            'fieldsets' => [
                                'main' => [
                                    'elements' => [
                                        'currency_id' => [
                                            'type' => Element\Hidden::class,
                                            'name' => 'id',
                                            'options' => [
                                                'required' => false,
                                            ],
                                            'attributes' => [
                                                'required' => false,
                                            ],
                                        ],
                                        'value' => [
                                            'type' => Element\Text::class,
                                            'name' => 'value',
                                            'lang' => true,
                                            'options' => [
                                                'label' => 'Наименование',
                                                'required' => true,
                                            ],
                                            'attributes' => [
                                                'required' => true,
                                            ],
                                        ],
                                        'sort' => [
                                            'type' => Element\Text::class,
                                            'name' => 'sort',
                                            'options' => [
                                                'label' => 'Сортировка',
                                                'required' => false,
                                            ],
                                            'attributes' => [
                                                'required' => false,
                                            ],
                                            'filters' => [
                                                [
                                                    'name' => \Yu\Core\Filter\ToSort::class,
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];
