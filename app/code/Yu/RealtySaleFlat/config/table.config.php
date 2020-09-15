<?php

declare(strict_types=1);

namespace Yu\RealtySaleFlat;

return [
    'admin' => [
        'table_manager' => [
            'realty-sale-flat' => [
                'columns' => [
                    [
                        'label' => 'Код',
                        'key' => 'code',
                    ],
                    [
                        'label' => 'Фото',
                        'key' => 'image',
                        'source' => [
                            'view_helper' => \Yu\Media\View\Helper\PreviewHelper::class,
                            'options' => function ($data) {
                                return array('path' => 'realty', 'pathId' => $data['id']);
                            }
                        ],
                    ],
                    [
                        'label' => 'Кол. комнат',
                        'key' => 'rooms',
                    ],
                    [
                        'label' => 'Район',
                        'key' => 'district',
                        'source' => [
                            'view_helper' => \Yu\Eav\View\Helper\ViewOptionHelper::class,
                            'options' => function ($data) {
                                return array('id' => $data['district']);
                            }
                        ],
                    ],
                    [
                        'label' => 'Адрес',
                        'key' => 'address',
                    ],
                    [
                        'label' => 'Цена',
                        'key' => 'price',
                    ],
                    [
                        'label' => 'Валюта',
                        'key' => 'currency',
                        'target_class' => \Yu\Price\Entity\Currency::class,
                        'findBy' => 'id',
                        'property' => 'name',
                    ],
                    [
                        'label' => 'Проект',
                        'key' => 'project',
                        'source' => [
                            'view_helper' => \Yu\Eav\View\Helper\ViewOptionHelper::class,
                            'options' => function ($data) {
                                return array('id' => $data['project']);
                            }
                        ],
                    ],
                    [
                        'label' => 'ID',
                        'key' => 'id',
                    ],
                    [
                        'label' => 'Активность',
                        'key' => 'active',
                    ],
                    [
                        'label' => 'На главной',
                        'key' => 'main',
                    ],
                ],
                'options' => [
                    'route' => 'admin/realty-sale-flat',
                ],
                'filter' => [
                    'district' => [
                        'type' => \DoctrineModule\Form\Element\ObjectSelect::class,
                        'name' => 'district',
                        'options' => [
                            'required' => false,
                            'object_manager' => '',
                            'target_class' => \Yu\Eav\Entity\EavValueOption::class,
                            'property' => 'title',
                            'label_generator' => function ($targetEntity) {
                                $value = $targetEntity->getValue();
                                return \Yu\Core\DataHelper::getDefaultLangValue($value);
                            },
                            'display_empty_item' => true,
                            'empty_item_label'   => '- все районы',
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
                            'required' => false,
                            'class' => 'form-control',
                            'placeholder' => 'Район',
                        ],
                    ],
                    'room' => [
                        'type' => \Laminas\Form\Element\Select::class,
                        'name' => 'room',
                        'options' => [
                            'label' => 'Количество комнат',

                            'value_options' => [
                                '' => '- любое количество комнат',
                                '1' => '1 ком.',
                                '2' => '2 ком.',
                                '3' => '3 ком.',
                                '4' => '4 ком.',
                                '5' => '5 ком.',
                                '6' => '6 ком.',
                                '7' => '7 ком.',
                                '8' => '8 ком.',
                                '9' => '9 ком.',
                                '10' => '10 ком.',
                            ],
                        ],
                        'attributes' => [
                            'required' => false,
                            'class' => 'form-control',
                        ],
                    ],
                    'agent_id' => [
                        'type' => \DoctrineModule\Form\Element\ObjectSelect::class,
                        'name' => 'agent_id',
                        'options' => [
                            'label' => 'Агент',
                            'target_class' => \Yu\Realty\Entity\Agent::class,
                            'property' => 'name',
                            'label_generator' => function ($targetEntity) {
                                $value = $targetEntity->getName();
                                return \Yu\Core\DataHelper::getDefaultLangValue($value);
                            },
                            'display_empty_item' => true,
                            'empty_item_label' => '- все агенты',
                        ],
                        'attributes' => [
                            'required' => false,
                            'class' => 'form-control',
                        ],
                    ],
                ],
            ],
        ],
    ],
];