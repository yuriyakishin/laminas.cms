<?php

declare(strict_types=1);

namespace Yu\RealtySaleFlat;

use Laminas\Form\Element;

return [
    'admin' => [
        'form_manager' => [
            'forms' => [
                // Forms
                'realty-sale-flat' => [
                    'action' => 'admin/realty-sale-flat/save',
                    'route-back' => 'admin/realty-sale-flat',
                    'lang' => true,
                    'tabs' => [
                        'main' => [
                            'label' => 'Параметры',
                            'sort' => 1,
                            'fieldsets' => [
                                'realty' => 'realty',
                                'params' => [
                                    'elements' => [
                                        'district' => [
                                            'type' => \DoctrineModule\Form\Element\ObjectSelect::class,
                                            'name' => 'district',
                                            'options' => [
                                                'label' => 'Район города',
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
                                                        'criteria' => ['optionId' => 100],
                                                        'orderBy'  => ['sort' => 'ASC'],
                                                    ],
                                                ],
                                            ],
                                            'attributes' => [
                                                'required' => true,
                                                'class' => 'custom-control-input',
                                            ],
                                        ],
                                        'rooms' => [
                                            'type' => Element\Select::class,
                                            'name' => 'rooms',
                                            'options' => [
                                                'label' => 'Количество комнат',
                                                'required' => true,
                                                'value_options' => [
                                                    '' => '- выберите',
                                                    '1' => '1',
                                                    '2' => '2',
                                                    '3' => '3',
                                                    '4' => '4',
                                                    '5' => '5',
                                                    '6' => '6',
                                                    '7' => '7',
                                                    '8' => '8',
                                                    '9' => '9',
                                                    '10' => '10',
                                                ],
                                            ],
                                            'attributes' => [
                                                'required' => true,
                                                'class' => 'custom-control-input',
                                            ],
                                        ],
                                        'floor' => [
                                            'type' => Element\Text::class,
                                            'name' => 'floor',
                                            'options' => [
                                                'label' => 'Этаж',
                                            ],
                                            'attributes' => [
                                                'required' => false,
                                            ],
                                        ],
                                        'floors' => [
                                            'type' => Element\Text::class,
                                            'name' => 'floors',
                                            'options' => [
                                                'label' => 'Этажность',
                                            ],
                                            'attributes' => [
                                                'required' => false,
                                            ],
                                        ],
                                        'area_all' => [
                                            'type' => Element\Text::class,
                                            'name' => 'area_all',
                                            'options' => [
                                                'label' => 'Общая площадь',
                                            ],
                                            'attributes' => [
                                                'required' => false,
                                            ],
                                        ],
                                        'area_live' => [
                                            'type' => Element\Text::class,
                                            'name' => 'area_live',
                                            'options' => [
                                                'label' => 'Жилая площадь',
                                            ],
                                            'attributes' => [
                                                'required' => false,
                                            ],
                                        ],
                                        'area_kitchen' => [
                                            'type' => Element\Text::class,
                                            'name' => 'area_kitchen',
                                            'options' => [
                                                'label' => 'Площадь кухни',
                                            ],
                                            'attributes' => [
                                                'required' => false,
                                            ],
                                        ],
                                        'project' => [
                                            'type' => \DoctrineModule\Form\Element\ObjectSelect::class,
                                            'name' => 'project',
                                            'options' => [
                                                'label' => 'Проект дома',
                                                'required' => true,
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
                                                        'criteria' => ['optionId' => 101],
                                                        'orderBy'  => ['sort' => 'ASC'],
                                                    ],
                                                ],
                                            ],
                                            'attributes' => [
                                                'required' => true,
                                                'class' => 'custom-control-input',
                                            ],
                                        ],
                                        'status' => [
                                            'type' => Element\Text::class,
                                            'name' => 'status',
                                            'lang' => true,
                                            'options' => [
                                                'label' => 'Юридический статус',
                                            ],
                                            'attributes' => [
                                                'required' => false,
                                            ],
                                        ],
                                        'anons' => [
                                            'type' => Element\Textarea::class,
                                            'name' => 'anons',
                                            'lang' => true,
                                            'options' => [
                                                'label' => 'Краткое описание',
                                            ],
                                            'attributes' => [
                                                'rows' => 3,
                                            ],
                                        ],
                                        'about' => [
                                            'type' => \Yu\Admin\Form\Element\Wiziwig::class,
                                            'name' => 'about',
                                            'lang' => true,
                                            'options' => [
                                                'label' => 'Описание',
                                                'class' => 'wiziwig',
                                            ],
                                            'attributes' => [
                                                'rows' => 10,
                                                'class' => 'wiziwig',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],

                        'price' => [
                            'label' => 'Цена',
                            'fieldsets' => [
                                'price' => 'price',
                            ],
                        ],

                        'geo' => [
                            'label' => 'Расположение',
                            'fieldsets' => [
                                //'map' => 'map',
                                'geo' => 'geo',
                            ],
                        ],

                        'images' => [
                            'label' => 'Фото',
                            'fieldsets' => [
                                'images' => [
                                    'fieldset' => 'images',
                                    'options' => [
                                        'path' => 'realty',
                                        'path_id' => 'realty[id]',
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