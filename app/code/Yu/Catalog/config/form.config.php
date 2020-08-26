<?php

declare(strict_types=1);

namespace Yu\Catalog;

use Laminas\Form\Element;

return [
    'admin' => [
        'form_manager' => [
            'forms' => [
                // Forms
                'catalog' => [
                    'action' => 'admin/catalog/save',
                    'route-back' => 'admin/catalog',
                    'lang' => true,
                    'tabs' => [
                        'main' => [
                            'label' => 'Содержание',
                            'sort' => 1,
                            'fieldsets' => [
                                'catalog' => [
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
                                        'category_id' => [
                                            'type' => \DoctrineModule\Form\Element\ObjectSelect::class,
                                            'name' => 'category_id',
                                            'options' => [
                                                'label' => 'Рубрика',
                                                'required' => false,
                                                'object_manager' => '',
                                                'target_class' => \Yu\Eav\Entity\EavValueOption::class,
                                                'property' => 'title',
                                                'label_generator' => function ($targetEntity) {
                                                    $value = $targetEntity->getValue();
                                                    return \Yu\Core\DataHelper::getDefaultLangValue($value);
                                                },
                                                'display_empty_item' => true,
                                                'empty_item_label'   => '- выберите',
                                                'is_method'      => true,
                                                'find_method'    => [
                                                    'name'   => 'findBy',
                                                    'params' => [
                                                        'criteria' => ['optionId' => 901],
                                                        'orderBy'  => ['sort' => 'ASC'],
                                                    ],
                                                ],
                                            ],
                                            'attributes' => [
                                                'required' => true,
                                                'class' => 'custom-control-input',
                                            ],
                                        ],
                                        'name' => [
                                            'type' => Element\Text::class,
                                            'name' => 'name',
                                            'lang' => true,
                                            'options' => [
                                                'label' => 'Заголовок',
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
                                        'phone' => [
                                            'type' => Element\Text::class,
                                            'name' => 'phone',
                                            'options' => [
                                                'label' => 'Телефон',
                                            ],
                                            'attributes' => [
                                                'required' => false,
                                            ],
                                        ],
                                        'email' => [
                                            'type' => Element\Text::class,
                                            'name' => 'email',
                                            'options' => [
                                                'label' => 'Email',
                                            ],
                                            'attributes' => [
                                                'required' => false,
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
                    ],
                ],
            ],
        ],
    ],
];
