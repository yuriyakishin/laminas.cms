<?php

declare(strict_types=1);

namespace Yu\User;

use Laminas\Form\Element;

return [
    'admin' => [
        'form_manager' => [
            'forms' => [
                // Form admin user profile
                'profile' => [
                    'action' => 'admin/profile/save',
                    'tabs' => [
                        'main' => [
                            'label' => 'Ваш профиль',
                            'sort' => 1,
                            'fieldsets' => [
                                'user' => [
                                    'object' => \Yu\User\Entity\User::class,
                                    'hydrator' => \Laminas\Hydrator\ClassMethodsHydrator::class,
                                    'elements' => [
                                        'name' => [
                                            'type' => Element\Text::class,
                                            'name' => 'name',
                                            'options' => [
                                                'label' => 'Имя',
                                                'required' => true,
                                            ],
                                            'attributes' => [
                                                'required' => true,
                                            ],
                                        ],
                                        'email' => [
                                            'type' => Element\Email::class,
                                            'name' => 'email',
                                            'options' => [
                                                'label' => 'Email',
                                                'required' => true,
                                            ],
                                            'attributes' => [
                                                'required' => true,
                                            ],
                                        ],
                                        'password' => [
                                            'type' => Element\Password::class,
                                            'name' => 'password',
                                            'options' => [
                                                'label' => 'Пароль',
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
