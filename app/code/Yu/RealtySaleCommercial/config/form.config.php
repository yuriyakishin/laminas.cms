<?php

declare(strict_types=1);

namespace Yu\RealtySaleCommercial;

use Laminas\Form\Element;

return [
    'admin' => [
        'form_manager' => [
            'forms' => [
                // Forms
                'realty-sale-commercial' => [
                    'action' => 'admin/realty-sale-commercial/save',
                    'route-back' => 'admin/realty-sale-commercial',
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
                                        'commercial' => [
                                            'type' => \DoctrineModule\Form\Element\ObjectSelect::class,
                                            'name' => 'commercial',
                                            'options' => [
                                                'label' => 'Виды коммерческой недвижимости',
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
                                                        'criteria' => ['optionId' => 301],
                                                        'orderBy'  => ['sort' => 'ASC'],
                                                    ],
                                                ],
                                            ],
                                            'attributes' => [
                                                'required' => true,
                                                'class' => 'custom-control-input',
                                            ],
                                        ],
                                        'area' => [
                                            'type' => Element\Text::class,
                                            'name' => 'area',
                                            'options' => [
                                                'label' => 'Площадь помещения',
                                            ],
                                            'attributes' => [
                                                'required' => false,
                                            ],
                                        ],
                                        'area_land' => [
                                            'type' => Element\Text::class,
                                            'name' => 'area_land',
                                            'options' => [
                                                'label' => 'Площадь участка',
                                            ],
                                            'attributes' => [
                                                'required' => false,
                                            ],
                                        ],
                                        'parking' => [
                                            'type' => Element\Text::class,
                                            'name' => 'parking',
                                            'lang' => true,
                                            'options' => [
                                                'label' => 'Паркинг',
                                            ],
                                            'attributes' => [
                                                'required' => false,
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