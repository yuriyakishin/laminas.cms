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
                                        'about' => [
                                            'type' => \Yu\Admin\Form\Element\Wiziwig::class,
                                            'name' => 'about',
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
                    ],
                ],
            ]
        ],
    ],
];