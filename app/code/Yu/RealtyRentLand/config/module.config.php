<?php

declare(strict_types=1);

namespace Yu\RealtyRentLand;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'admin' => [
                'child_routes' => [
                    'realty-rent-land' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/realty/rent/land',
                            'defaults' => [
                                'controller' => 'Yu\RealtyRentLand\Controller\Admin\RentLandController',
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
                                        'controller' => 'Yu\RealtyRentLand\Controller\Admin\RentLandController',
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
                                        'controller' => 'Yu\RealtyRentLand\Controller\Admin\RentLandController',
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
                                        'controller' => 'Yu\RealtyRentLand\Controller\Admin\RentLandController',
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
            'Yu\RealtyRentLand\Controller\Admin\RentLandController' => Controller\Admin\Factory\RentLandControllerFactory::class,
        ],
    ],

    'realty' => [
        'rent-land' => [
            'name' => 'rent land',
            'admin' => [
                'options' => [
                    'title' => 'Аренда земли',
                    'table' => 'realty-rent-land',
                    'form' => 'realty-rent-land',
                    'route' => 'admin/realty-rent-land',
                    'type' => 'rent-land',
                ],
            ],
            'attributes' => [
                'district' => [
                    'id' => 100,
                    'code' => 'district',
                    'label' => 'District',
                    'type' => 'int',
                ],
                'area' => [
                    'id' => 401,
                    'code' => 'area',
                    'label' => 'Area land',
                    'type' => 'text',
                ],
                'building' => [
                    'id' => 402,
                    'code' => 'building',
                    'label' => 'Building',
                    'type' => 'text',
                ],
                'anons' => [
                    'id' => 107,
                    'code' => 'anons',
                    'label' => 'Anons',
                    'type' => 'text',
                ],
                'about' => [
                    'id' => 108,
                    'code' => 'about',
                    'label' => 'About',
                    'type' => 'text',
                ],
            ],
        ],
    ],
];
