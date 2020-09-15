<?php

declare(strict_types=1);

namespace Yu\Gallery;

use Laminas\Form\Element;

return [
    'admin' => [
        'form_manager' => [
            'forms' => [
                // Forms
                'gallery' => [
                    'action' => 'admin/gallery/save',
                    'route-back' => 'admin/gallery',
                    'lang' => true,
                    'tabs' => [
                        'main' => [
                            'label' => 'Галереи',
                            'sort' => 1,
                            'fieldsets' => [
                                'gallery' => [
                                    'elements' => [
                                        'page_id' => [
                                            'type' => Element\Hidden::class,
                                            'name' => 'id',
                                            'options' => [
                                                'required' => false,
                                            ],
                                            'attributes' => [
                                                'required' => false,
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
                                        'title' => [
                                            'type' => Element\Text::class,
                                            'name' => 'title',
                                            'lang' => true,
                                            'options' => [
                                                'label' => 'Заголовок',
                                                'required' => true,
                                            ],
                                            'attributes' => [
                                                'required' => true,
                                            ],
                                        ],
                                        'identifier' => [
                                            'type' => Element\Text::class,
                                            'name' => 'identifier',
                                            'options' => [
                                                'label' => 'Идентификатор',
                                                'required' => true,
                                                'help' => 'URL страницы',
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
                                                'label' => 'Описание',
                                                'required' => true,
                                                'class' => 'wiziwig',
                                            ],
                                            'attributes' => [
                                                'required' => true,
                                                'rows' => 10,
                                                'class' => 'wiziwig',
                                            ],
                                        ],


                                    ],
                                ],
                            ],
                        ],

                        'images' => [
                            'label' => 'Фото',
                            'fieldsets' => [
                                'images' => [
                                    'fieldset' => 'images',
                                    'options' => [
                                        'path' => 'gallery',
                                        'path_id' => 'gallery[id]',
                                    ],
                                ],
                            ],
                        ],

                        'seo' => [
                            'label' => 'SEO',
                            'fieldsets' => [
                                'meta' => 'meta',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];
