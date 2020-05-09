<?php

declare(strict_types=1);

namespace Yu\Price;

use Laminas\Form\Element;

return [
    'admin' => [
        'form_manager' => [
            'forms' => [
                // Forms
                'currency' => [
                    'action' => 'admin/currency/save',
                    'route-back' => 'admin/currency',
                    'tabs' => [
                        'main' => [
                            'label' => 'Валюта',
                            'sort' => 1,
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
                                        'name' => [
                                            'type' => Element\Text::class,
                                            'name' => 'name',
                                            'options' => [
                                                'label' => 'Наименование валюты',
                                                'required' => true,
                                            ],
                                            'attributes' => [
                                                'required' => true,
                                            ],
                                        ],
                                        'code' => [
                                            'type' => Element\Text::class,
                                            'name' => 'code',
                                            'options' => [
                                                'label' => 'Код',
                                                'required' => true,
                                                'help' => 'Например: EUR, DOL',
                                            ],
                                            'attributes' => [
                                                'required' => true,
                                            ],
                                        ],
                                        'unit' => [
                                            'type' => Element\Text::class,
                                            'name' => 'unit',
                                            'options' => [
                                                'label' => 'Единица',
                                                'required' => false,
                                            ],
                                            'attributes' => [
                                                'required' => false,
                                            ],
                                        ],
                                        'course' => [
                                            'type' => Element\Text::class,
                                            'name' => 'course',
                                            'options' => [
                                                'label' => 'Курс',
                                                'required' => true,
                                            ],
                                            'attributes' => [
                                                'required' => true,
                                            ],
                                            'filters' => [
                                                [
                                                    'name' => \Laminas\Filter\ToFloat::class,
                                                ],
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
                                                    'name' => \Laminas\Filter\ToInt::class,
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

            'fieldsets' => [
                'price' => [
                    'elements' => [
                        'value' => [
                            'type' => Element\Text::class,
                            'name' => 'value',
                            'options' => [
                                'label' => 'Цена',
                            ],
                            'attributes' => [
                                'required' => true,
                            ],
                        ],
                        'currency_id' => [
                            'type' => \DoctrineModule\Form\Element\ObjectSelect::class,
                            'name' => 'currency_id',
                            'options' => [
                                'label' => 'Валюта',
                                'required' => true,
                                'target_class' => \Yu\Price\Entity\Currency::class,
                                'property' => 'name',
                                'label_generator' => function ($targetEntity) {
                                    $value = $targetEntity->getName();
                                    return \Yu\Core\DataHelper::getDefaultLangValue($value);
                                },
                            ],
                            'attributes' => [
                                'required' => true,
                                'class' => 'custom-control-input',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];
