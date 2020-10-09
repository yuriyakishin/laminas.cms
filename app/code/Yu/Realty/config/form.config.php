<?php

declare(strict_types=1);

namespace Yu\Realty;

use Laminas\Form\Element;

return [
    'admin' => [
        'form_manager' => [
            'forms' => [
                // Forms
                'agent' => [
                    'action' => 'admin/agent/save',
                    'route-back' => 'admin/agent',
                    'lang' => true,
                    'tabs' => [
                        'main' => [
                            'label' => 'Агент',
                            'sort' => 1,
                            'fieldsets' => [
                                'agent' => [
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
                                            'lang' => true,
                                            'options' => [
                                                'label' => 'ФИО',
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
                                                'label' => 'Код сотрудника',
                                                'required' => false,
                                            ],
                                            'attributes' => [
                                                'required' => false,
                                            ],
                                        ],
                                        'phone1' => [
                                            'type' => Element\Text::class,
                                            'name' => 'phone1',
                                            'lang' => true,
                                            'options' => [
                                                'label' => 'Телефон',
                                            ],
                                            'attributes' => [

                                            ],
                                        ],
                                        'phone2' => [
                                            'type' => Element\Text::class,
                                            'name' => 'phone2',
                                            'lang' => true,
                                            'options' => [
                                                'label' => 'Телефон личный',
                                            ],
                                            'attributes' => [

                                            ],
                                        ],
                                        'email' => [
                                            'type' => Element\Text::class,
                                            'name' => 'email',
                                            'options' => [
                                                'label' => 'Email',
                                            ],
                                            'attributes' => [

                                            ],
                                        ],
                                        'post' => [
                                            'type' => Element\Text::class,
                                            'name' => 'post',
                                            'lang' => true,
                                            'options' => [
                                                'label' => 'Должность',
                                            ],
                                            'attributes' => [

                                            ],
                                        ],
                                        'adout' => [
                                            'type' => \Yu\Admin\Form\Element\Wiziwig::class,
                                            'name' => 'adout',
                                            'lang' => true,
                                            'options' => [
                                                'label' => 'О сотруднике',
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
                                        'path' => 'agent',
                                        'path_id' => 'agent[id]',
                                    ],
                                ],
                            ],
                        ],

                    ],
                ],
            ],

            'fieldsets' => [
                'realty' => [
                    'elements' => [
                        'realty_id' => [
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
                            'filters' => [
                                [
                                    'name' => \Laminas\Filter\ToInt::class,
                                ],
                            ],
                        ],
                        'main' => [
                            'type' => Element\Select::class,
                            'name' => 'main',
                            'options' => [
                                'label' => 'Показывать на главной',
                                'required' => false,
                                'value_options' => [
                                    '0' => 'Нет',
                                    '1' => 'Да',
                                ],
                            ],
                            'attributes' => [
                                'required' => false,
                                'class' => 'custom-control-input',
                            ],
                            'filters' => [
                                [
                                    'name' => \Laminas\Filter\ToInt::class,
                                ],
                            ],
                        ],
                        'code' => [
                            'type' => Element\Text::class,
                            'name' => 'code',
                            'options' => [
                                'label' => 'Код',
                                'required' => false,
                            ],
                            'attributes' => [
                                'required' => false,
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
                                'empty_item_label' => '- выберите',
                            ],
                            'attributes' => [
                                'required' => true,
                                'class' => 'form-control',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];