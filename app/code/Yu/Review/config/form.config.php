<?php

declare(strict_types=1);

namespace Yu\Review;

use Laminas\Form\Element;

return [
    'admin' => [
        'form_manager' => [
            'forms' => [
                // Forms
                'review' => [
                    'action' => 'admin/review/save',
                    'route-back' => 'admin/review',
                    'lang' => true,
                    'tabs' => [
                        'main' => [
                            'label' => 'Содержание',
                            'sort' => 1,
                            'fieldsets' => [
                                'review' => [
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
                                            'name' => 'active',
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
                                        'name' => [
                                            'type' => Element\Text::class,
                                            'name' => 'name',
                                            'lang' => true,
                                            'options' => [
                                                'label' => 'Имя',
                                                'required' => true,
                                            ],
                                            'attributes' => [
                                                'required' => true,
                                            ],
                                        ],
                                        'content' => [
                                            'type' => \Yu\Admin\Form\Element\Wiziwig::class,
                                            'name' => 'content',
                                            'lang' => true,
                                            'options' => [
                                                'label' => 'Отзыв',
                                                'required' => true,
                                                'class' => 'wiziwig',
                                            ],
                                            'attributes' => [
                                                'required' => true,
                                                'rows' => 15,
                                                'class' => 'wiziwig',
                                            ],
                                        ],
                                        'sort' => [
                                            'type' => Element\Text::class,
                                            'name' => 'sort',
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

                        'images' => [
                            'label' => 'Фото отзыва',
                            'fieldsets' => [
                                'images' => [
                                    'fieldset' => 'images',
                                    'options' => [
                                        'path' => 'review',
                                        'path_id' => 'review[id]',
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
