<?php

declare(strict_types=1);

namespace Yu\RealtySaleLand;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'sale-land' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/sale-land',
                    'defaults' => [
                        'controller' => 'Yu\RealtySaleLand\Controller\SaleLandController',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'view' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/[:id]',
                            'defaults' => [
                                'controller' => 'Yu\RealtySaleLand\Controller\SaleLandController',
                                'action' => 'view',
                                'id' => '',
                            ],
                        ],
                    ],
                ],
            ],

            'admin' => [
                'child_routes' => [
                    'realty-sale-land' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/realty/sale/land',
                            'defaults' => [
                                'controller' => 'Yu\RealtySaleLand\Controller\Admin\SaleLandController',
                                'action' => 'index',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'edit' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => '/edit[/:id]',
                                    'defaults' => [
                                        'controller' => 'Yu\RealtySaleLand\Controller\Admin\SaleLandController',
                                        'action' => 'edit',
                                        'id' => 0,
                                    ],
                                ],
                            ],
                            'delete' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => '/delete',
                                    'defaults' => [
                                        'controller' => 'Yu\RealtySaleLand\Controller\Admin\SaleLandController',
                                        'action' => 'delete',
                                        'id' => 0,
                                    ],
                                ],
                            ],
                            'save' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => '/save[/:id]',
                                    'defaults' => [
                                        'controller' => 'Yu\RealtySaleLand\Controller\Admin\SaleLandController',
                                        'action' => 'save',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],

    'controllers' => [
        'factories' => [
            'Yu\RealtySaleLand\Controller\SaleLandController' => Controller\Factory\SaleLandControllerFactory::class,
            'Yu\RealtySaleLand\Controller\Admin\SaleLandController' => Controller\Admin\Factory\SaleLandControllerFactory::class,
        ],
    ],

    'realty' => [
        'sale-land' => [
            'name' => 'Sale land',
            'admin' => [
                'options' => [
                    'title' => 'Продажа земли',
                    'table' => 'realty-sale-land',
                    'form' => 'realty-sale-land',
                    'route' => 'admin/realty-sale-land',
                    'type' => 'sale-land',
                ],
            ],
            'attributes' => [
                'district' => [
                    'id' => 100,
                    'code' => 'district',
                    'label' => 'Район',
                    'type' => 'int',
                    'options' => true,
                ],
                'area' => [
                    'id' => 401,
                    'code' => 'area',
                    'label' => 'Площадь земли',
                    'type' => 'text',
                ],
                'building' => [
                    'id' => 402,
                    'code' => 'building',
                    'label' => 'Постройки',
                    'type' => 'text',
                ],
                'status' => [
                    'id' => 106,
                    'code' => 'status',
                    'label' => 'Статус',
                    'type' => 'text',
                ],
                'anons' => [
                    'id' => 107,
                    'code' => 'anons',
                    'label' => 'Анонс',
                    'type' => 'text',
                ],
                'about' => [
                    'id' => 108,
                    'code' => 'about',
                    'label' => 'Описание',
                    'type' => 'text',
                ],
            ],

            'labels' => [
                'catalog' => 'Продажа земли',
                'view' => 'Продается земля',
                'item' => 'Продается земля',
            ],

            'repository' => [
                'realty-repository' => \Yu\RealtySaleLand\Repository\SaleLandRepository::class,
                'criterial-bilder' => \Yu\RealtySaleLand\Repository\SearchCriteriaBuilder::class,
            ],
        ],
    ],
];
