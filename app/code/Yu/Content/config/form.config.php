<?php

declare(strict_types=1);

namespace Yu\Content;

use Laminas\Form\Element;

return [
    'admin' => [
        'form_manager' => [
            'forms' => [
                // Forms
                'page' => [
                    'action' => 'admin/page/save',
                    'route-back' => 'admin/page',
                    'lang' => true,
                    'tabs' => [
                        'main' => [
                            'label' => 'Страница',
                            'sort' => 1,
                            'fieldsets' => [
                                'page' => [
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
                                                'label' => 'Содержимое',
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

                        'seo' => [
                            'label' => 'SEO',
                            'sort' => 1,
                            'fieldsets' => [
                                'meta' => 'meta',
                            ],
                        ],
                    ],
                ],

                'block' => [
                    'action' => 'admin/block/save',
                    'route-back' => 'admin/block',
                    'lang' => true,
                    'tabs' => [
                        'main' => [
                            'label' => 'Блок',
                            'sort' => 1,
                            'fieldsets' => [
                                'block' => [
                                    'elements' => [
                                        'block_id' => [
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
                                                'label' => 'Наименование блока',
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
                                            'type' => Element\Textarea::class,
                                            'name' => 'content',
                                            'lang' => true,
                                            'options' => [
                                                'label' => 'Содержимое',
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
                    ],
                ],
            ],
        ],
    ],
];
