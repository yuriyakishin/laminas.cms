<?php

declare(strict_types=1);

namespace Yu\Realty;

use Laminas\Form\Element;

return [
    'feedback' => [
        'realty-order' => [
            'subject' => 'Просьба проконсультировать по объекту недвижимости',
            'hydrator' => \Laminas\Hydrator\ArraySerializableHydrator::class,
            'elements' => [
                [
                    'spec' => [
                        'type' => Element\Text::class,
                        'name' => 'code',
                        'options' => [
                            'label' => 'Код объекта недвижимости',
                        ]
                    ],
                ],
                [
                    'spec' => [
                        'type' => Element\Text::class,
                        'name' => 'name',
                        'options' => [
                            'label' => 'Имя',
                        ]
                    ],
                ],
                [
                    'spec' => [
                        'type' => Element\Tel::class,
                        'name' => 'phone',
                        'options' => [
                            'label' => 'Телефон',
                        ]
                    ],
                ],
                [
                    'spec' => [
                        'type' => Element\Email::class,
                        'name' => 'email',
                        'options' => [
                            'label' => 'Email',
                        ]
                    ],
                ],
                [
                    'spec' => [
                        'type' => Element\Textarea::class,
                        'name' => 'message',
                        'options' => [
                            'label' => 'Сообщение',
                        ]
                    ],
                ],
            ],
            'input_filter' => [
                [
                    'name' => 'email',
                    'required' => false,
                ],
                [
                    'name' => 'message',
                    'required' => false,
                ],
            ],
        ],

        'realty-estimate' => [
            'subject' => 'Просьба Оценить недвижимость On-line',
            'hydrator' => \Laminas\Hydrator\ArraySerializableHydrator::class,
            'elements' => [
                [
                    'spec' => [
                        'type' => Element\Text::class,
                        'name' => 'name',
                        'options' => [
                            'label' => 'Имя',
                        ]
                    ],
                ],
                [
                    'spec' => [
                        'type' => Element\Tel::class,
                        'name' => 'phone',
                        'options' => [
                            'label' => 'Телефон',
                        ]
                    ],
                ],
                [
                    'spec' => [
                        'type' => Element\Email::class,
                        'name' => 'email',
                        'options' => [
                            'label' => 'Email',
                        ]
                    ],
                ],
                [
                    'spec' => [
                        'type' => Element\Textarea::class,
                        'name' => 'message',
                        'options' => [
                            'label' => 'Сообщение',
                        ]
                    ],
                ],
            ],
            'input_filter' => [
                [
                    'name' => 'email',
                    'required' => false,
                ],
                [
                    'name' => 'message',
                    'required' => false,
                ],
            ],
        ],

        'realty-find' => [
            'subject' => 'Не нашли подходящий объект? Оставьте заявку, мы подберем подходящий Вам вариант!',
            'hydrator' => \Laminas\Hydrator\ArraySerializableHydrator::class,
            'elements' => [
                [
                    'spec' => [
                        'type' => Element\Text::class,
                        'name' => 'name',
                        'options' => [
                            'label' => 'Имя',
                        ]
                    ],
                ],
                [
                    'spec' => [
                        'type' => Element\Tel::class,
                        'name' => 'phone',
                        'options' => [
                            'label' => 'Телефон',
                        ]
                    ],
                ],
                [
                    'spec' => [
                        'type' => Element\Textarea::class,
                        'name' => 'message',
                        'options' => [
                            'label' => 'Сообщение',
                        ]
                    ],
                ],
            ],
            'input_filter' => [
                [
                    'name' => 'name',
                    'required' => false,
                ],
                [
                    'name' => 'message',
                    'required' => false,
                ],
            ],
        ],
    ],
];