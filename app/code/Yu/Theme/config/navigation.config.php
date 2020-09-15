<?php

declare(strict_types=1);

namespace Yu\Content;

return [
    'navigation' => [
        'top' => [
            'home' => [
                'label' => 'Главная',
                'uri' => '/',
                'order' => 100,
            ],
            'company' => [
                'label' => 'О компании',
                'uri' => 'javascript: void(0)',
                'order' => 200,
                'pages' => [
                    [
                        'label' => 'О компании',
                        'uri' => '/about',
                        'order' => 100,
                    ],
                    [
                        'label' => 'Сертификаты и награды',
                        'uri' => '/about/awards',
                        'order' => 200,
                    ],
                    [
                        'label' => 'Отзывы о кампании',
                        'uri' => '/review',
                        'order' => 200,
                    ],
                    [
                        'label' => 'Видеовизитка РК',
                        'uri' => '/videovizitka',
                        'order' => 300,
                    ],
                    [
                        'label' => 'Образцы договоров',
                        'uri' => '/docs',
                        'order' => 400,
                    ],
                ],
            ],

            'service' => [
                'label' => 'Услуги',
                'uri' => 'javascript: void(0)',
                'order' => 300,
                'pages' => [
                    [
                        'label' => 'Риэлторские услуги',
                        'uri' => '/realtor-services',
                        'order' => 100,
                    ],
                    [
                        'label' => 'Инвестиционные услуги',
                        'uri' => '/investment-services',
                        'order' => 200,
                    ],
                ],
            ],

            'jobs' => [
                'label' => 'Вакансии',
                'uri' => '/jobs',
                'order' => 400,
            ],

            'news' => [
                'label' => 'Новости',
                'uri' => '/news',
                'order' => 500,
            ],

            'useful' => [
                'label' => 'Полезное',
                'uri' => '#',
                'order' => 600,
                'pages' => [
                    [
                        'label' => 'Доска объявлений',
                        'uri' => '/board',
                        'order' => 100,
                    ],
                    [
                        'label' => 'Фотогалерея Мариуполя',
                        'uri' => '/photogallery',
                        'order' => 200,
                    ],
                    [
                        'label' => 'Типовые планировки',
                        'uri' => '/plan',
                        'order' => 300,
                    ],
                    [
                        'label' => 'Статьи',
                        'uri' => '/article',
                        'order' => 400,
                    ],
                    [
                        'label' => 'А получится ли из Вас риэлтор?',
                        'uri' => '/anketa',
                        'order' => 500,
                    ],
                    [
                        'label' => 'Опросы',
                        'uri' => '/poll',
                        'order' => 600,
                    ],
                ],
            ],

            'buy' => [
                'label' => 'Купим / снимем',
                'uri' => '/buy',
                'order' => 700,
            ],

            'cnt' => [
                'label' => 'Контакты',
                'uri' => '/contacts',
                'order' => 800,
            ],
        ],

        'pages' => [

        ],
    ],
];