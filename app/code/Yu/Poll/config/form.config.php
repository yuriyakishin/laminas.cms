<?php

declare(strict_types=1);

namespace Yu\Poll;

use Laminas\Form\Element;

return [
    'admin' => [
        'form_manager' => [
            'forms' => [
                // Forms
                'poll' => [
                    'action' => 'admin/poll/save',
                    'route-back' => 'admin/poll',
                    'lang' => false,
                    'tabs' => [
                        'main' => [
                            'label' => 'Опрос',
                            'sort' => 1,
                            'fieldsets' => [
                                'poll' => [
                                    'elements' => [
                                        'poll_id' => [
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
                                        'value' => [
                                            'type' => Element\Textarea::class,
                                            'name' => 'value',
                                            'lang' => false,
                                            'options' => [
                                                'label' => 'Тема опроса',
                                                'required' => true,
                                            ],
                                            'attributes' => [
                                                'required' => true,
                                            ],
                                        ],
                                    ],
                                ],
                                'options' => [
                                    'elements' => [
                                        'option_1' => [
                                            'type' => Element\Text::class,
                                            'name' => 'option_1',
                                            'lang' => false,
                                            'options' => [
                                                'label' => 'Ответ №1',
                                                'required' => false,
                                            ],
                                            'attributes' => [
                                                'required' => false,
                                            ],
                                        ],
                                        'option_2' => [
                                            'type' => Element\Text::class,
                                            'name' => 'option_2',
                                            'lang' => false,
                                            'options' => [
                                                'label' => 'Ответ №2',
                                                'required' => false,
                                            ],
                                            'attributes' => [
                                                'required' => false,
                                            ],
                                        ],
                                        'option_3' => [
                                            'type' => Element\Text::class,
                                            'name' => 'option_3',
                                            'lang' => false,
                                            'options' => [
                                                'label' => 'Ответ №3',
                                                'required' => false,
                                            ],
                                            'attributes' => [
                                                'required' => false,
                                            ],
                                        ],
                                        'option_4' => [
                                            'type' => Element\Text::class,
                                            'name' => 'option_4',
                                            'lang' => false,
                                            'options' => [
                                                'label' => 'Ответ №4',
                                                'required' => false,
                                            ],
                                            'attributes' => [
                                                'required' => false,
                                            ],
                                        ],
                                        'option_5' => [
                                            'type' => Element\Text::class,
                                            'name' => 'option_5',
                                            'lang' => false,
                                            'options' => [
                                                'label' => 'Ответ №5',
                                                'required' => false,
                                            ],
                                            'attributes' => [
                                                'required' => false,
                                            ],
                                        ],
                                        'option_6' => [
                                            'type' => Element\Text::class,
                                            'name' => 'option_6',
                                            'lang' => false,
                                            'options' => [
                                                'label' => 'Ответ №6',
                                                'required' => false,
                                            ],
                                            'attributes' => [
                                                'required' => false,
                                            ],
                                        ],
                                        'option_7' => [
                                            'type' => Element\Text::class,
                                            'name' => 'option_7',
                                            'lang' => false,
                                            'options' => [
                                                'label' => 'Ответ №7',
                                                'required' => false,
                                            ],
                                            'attributes' => [
                                                'required' => false,
                                            ],
                                        ],
                                        'option_8' => [
                                            'type' => Element\Text::class,
                                            'name' => 'option_8',
                                            'lang' => false,
                                            'options' => [
                                                'label' => 'Ответ №8',
                                                'required' => false,
                                            ],
                                            'attributes' => [
                                                'required' => false,
                                            ],
                                        ],
                                        'option_9' => [
                                            'type' => Element\Text::class,
                                            'name' => 'option_9',
                                            'lang' => false,
                                            'options' => [
                                                'label' => 'Ответ №9',
                                                'required' => false,
                                            ],
                                            'attributes' => [
                                                'required' => false,
                                            ],
                                        ],
                                        'option_10' => [
                                            'type' => Element\Text::class,
                                            'name' => 'option_10',
                                            'lang' => false,
                                            'options' => [
                                                'label' => 'Ответ №10',
                                                'required' => false,
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