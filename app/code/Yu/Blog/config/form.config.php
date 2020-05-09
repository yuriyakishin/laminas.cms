<?php

declare(strict_types=1);

namespace Yu\Blog;

use Laminas\Form\Element;

return [
    'admin' => [
        'form_manager' => [
            'forms' => [
                // Forms
                'blog-rubric' => [
                    'action' => 'admin/blog/save',
                    'route-back' => 'admin/blog',
                    'lang' => true,
                    'tabs' => [
                        'main' => [
                            'label' => 'Рубрика',
                            'sort' => 1,
                            'fieldsets' => [
                                'rubric' => [
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
                                                'label' => 'Название рубрики',
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

                        'seo' => [
                            'label' => 'SEO',
                            'sort' => 1,
                            'fieldsets' => [
                                'meta' => 'meta',
                            ],
                        ],
                    ],
                ],

                'blog-post' => [
                    'action' => 'admin/post/save',
                    'route-back' => 'admin/post',
                    'lang' => true,
                    'tabs' => [
                        'main' => [
                            'label' => 'Рубрика',
                            'sort' => 1,
                            'fieldsets' => [
                                'post' => [
                                    'use_as_base_bieldset' => true,
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
                                        'rubric_id' => [
                                            'type' => \DoctrineModule\Form\Element\ObjectSelect::class,
                                            'name' => 'rubric_id',
                                            'options' => [
                                                'label' => 'Рубрика',
                                                'required' => false,
                                                'object_manager' => '',
                                                'target_class' => \Yu\Blog\Entity\Rubric::class,
                                                'property' => 'title',
                                                'label_generator' => function ($targetEntity) {
                                                    $value = $targetEntity->getTitle();
                                                    return \Yu\Core\DataHelper::getDefaultLangValue($value);
                                                },
                                                //'source_class' => \Yu\Blog\Model\Source\RubricSource::class,
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
                                                    'name' => \Yu\Core\Filter\StringToDateTime::class,
                                                    'options' => [
                                                        'format' => 'Y-m-d'
                                                    ],
                                                ],
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
                            'label' => 'Фото',
                            'sort' => 1,
                            'fieldsets' => [
                                'images' => [
                                    'fieldset' => 'images',
                                    'options' => [
                                        'path' => 'post',
                                        'path_id' => 'post[id]',
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
            ],
        ],
    ],
];
