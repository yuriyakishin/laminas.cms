<?php

declare(strict_types=1);

namespace Yu\Board;

use Laminas\Form\Element;

return [
    'admin' => [
        'form_manager' => [
            'forms' => [
                // Forms

                'board' => [
                    'action' => 'admin/board/save',
                    'route-back' => 'admin/board',
                    'tabs' => [
                        'main' => [
                            'label' => 'Содержание объявления',
                            'sort' => 1,
                            'fieldsets' => [
                                'board' => [
                                    'elements' => [
                                        'id' => [
                                            'type' => Element\Hidden::class,
                                            'name' => 'id',
                                            'options' => [
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
                                        'active' => [
                                            'type' => Element\Select::class,
                                            'name' => 'view',
                                            'options' => [
                                                'label' => 'Активность',
                                                'required' => false,
                                                'value_options' => [
                                                    '1' => 'Да',
                                                    '0' => 'Нет',
                                                ],
                                            ],
                                            'attributes' => [
                                                'required' => false,
                                                'class' => 'custom-control-input',
                                            ],
                                        ],
                                        'type_id' => [
                                            'type' => \DoctrineModule\Form\Element\ObjectSelect::class,
                                            'name' => 'type_id',
                                            'options' => [
                                                'label' => 'Рубрика',
                                                'required' => false,
                                                'object_manager' => '',
                                                'target_class' => \Yu\Board\Entity\BoardType::class,
                                                'property' => 'name',
                                                'label_generator' => function ($targetEntity) {
                                                    $value = $targetEntity->getName();
                                                    return $value;
                                                },
                                            ],
                                            'attributes' => [
                                                'required' => false,
                                                'class' => 'custom-control-input',
                                            ],
                                        ],
                                        'city_id' => [
                                            'type' => \DoctrineModule\Form\Element\ObjectSelect::class,
                                            'name' => 'city_id',
                                            'options' => [
                                                'label' => 'Город',
                                                'required' => false,
                                                'object_manager' => '',
                                                'target_class' => \Yu\Board\Entity\BoardCity::class,
                                                'property' => 'name',
                                                'label_generator' => function ($targetEntity) {
                                                    $value = $targetEntity->getName();
                                                    return $value;
                                                },
                                            ],
                                            'attributes' => [
                                                'required' => false,
                                                'class' => 'custom-control-input',
                                            ],
                                        ],

                                        'date' => [
                                            'type' => Element\Date::class,
                                            'name' => 'date',
                                            'options' => [
                                                'label' => 'Дата публикации',
                                                'required' => true,
                                            ],
                                            'attributes' => [
                                                'min' => '2012-01-01',
                                                'max' => '2028-01-01',
                                                'step' => '1',
                                                'required' => true,
                                            ],
                                            'filters' => [
                                                [
                                                    'name' => \Yu\Core\Filter\DateTimeToUnixFormat::class,
                                                    'options' => [
                                                        'format' => 'Y-m-d'
                                                    ],
                                                ],
                                            ],
                                        ],
                                        'phone' => [
                                            'type' => Element\Text::class,
                                            'name' => 'phone',
                                            'options' => [
                                                'label' => 'Телефоны',
                                                'required' => true,
                                            ],
                                            'attributes' => [
                                                'required' => true,
                                            ],
                                        ],
                                        'message' => [
                                            'type' => Element\Textarea::class,
                                            'name' => 'message',
                                            'options' => [
                                                'label' => 'Объявление',
                                                'required' => false,
                                            ],
                                            'attributes' => [
                                                'required' => false,
                                                'rows' => 8,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],

                'board-city' => [
                    'action' => 'admin/board-city/save',
                    'route-back' => 'admin/board-city',
                    'tabs' => [
                        'main' => [
                            'label' => 'Города',
                            'sort' => 1,
                            'fieldsets' => [
                                'main' => [
                                    'elements' => [
                                        'id' => [
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
                                                'label' => 'Наименование города',
                                            ],
                                            'attributes' => [
                                                'required' => true,
                                            ],
                                        ],

                                        'sort' => [
                                            'type' => Element\Text::class,
                                            'name' => 'num',
                                            'options' => [
                                                'label' => 'Сортировка',
                                            ],
                                            'attributes' => [
                                                'required' => false,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],

                'board-type' => [
                    'action' => 'admin/board-type/save',
                    'route-back' => 'admin/board-type',
                    'tabs' => [
                        'main' => [
                            'label' => 'Разделы',
                            'sort' => 1,
                            'fieldsets' => [
                                'main' => [
                                    'elements' => [
                                        'id' => [
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
                                                'label' => 'Наименование раздела',
                                            ],
                                            'attributes' => [
                                                'required' => true,
                                            ],
                                        ],

                                        'sort' => [
                                            'type' => Element\Text::class,
                                            'name' => 'num',
                                            'options' => [
                                                'label' => 'Сортировка',
                                            ],
                                            'attributes' => [
                                                'required' => false,
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
