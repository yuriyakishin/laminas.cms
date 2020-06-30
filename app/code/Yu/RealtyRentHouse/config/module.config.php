<?php

declare(strict_types=1);

namespace Yu\RealtyRentHouse;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'rent-house' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/rent-house',
                    'defaults' => [
                        'controller' => 'Yu\RealtyRentHouse\Controller\RentHouseController',
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
                                'controller' => 'Yu\RealtyRentHouse\Controller\RentHouseController',
                                'action' => 'view',
                                'id' => '',
                            ],
                        ],
                    ],
                ],
            ],
            'admin' => [
                'child_routes' => [
                    'realty-rent-house' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/realty/rent/house',
                            'defaults' => [
                                'controller' => 'Yu\RealtyRentHouse\Controller\Admin\RentHouseController',
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
                                        'controller' => 'Yu\RealtyRentHouse\Controller\Admin\RentHouseController',
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
                                        'controller' => 'Yu\RealtyRentHouse\Controller\Admin\RentHouseController',
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
                                        'controller' => 'Yu\RealtyRentHouse\Controller\Admin\RentHouseController',
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
            'Yu\RealtyRentHouse\Controller\RentHouseController' => Controller\Factory\RentHouseControllerFactory::class,

            'Yu\RealtyRentHouse\Controller\Admin\RentHouseController' => Controller\Admin\Factory\RentHouseControllerFactory::class,
            'Yu\RealtyRentHouse\Controller\Admin\ValueOptionClass' => Controller\Admin\Factory\ValueOptionClassControllerFactory::class,
        ],
    ],

    'realty' => [
        'rent-house' => [
            'name' => 'rent house',
            'admin' => [
                'options' => [
                    'title' => 'Аренда домов',
                    'table' => 'realty-rent-house',
                    'form' => 'realty-rent-house',
                    'route' => 'admin/realty-rent-house',
                    'type' => 'rent-house',
                ],
            ],
            'attributes' => [
                'district' => [
                    'id' => 100,
                    'code' => 'district',
                    'label' => 'Район города',
                    'type' => 'int',
                    'options' => true,
                ],
                'rooms' => [
                    'id' => 101,
                    'code' => 'rooms',
                    'label' => 'Количество комнат',
                    'type' => 'int',
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
        ],
    ],

];
