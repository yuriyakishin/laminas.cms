<?php

declare(strict_types=1);

namespace Yu\RealtySaleHouse;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'admin' => [
                'child_routes' => [
                    'realty-sale-house' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/realty/sale/house',
                            'defaults' => [
                                'controller' => 'Yu\RealtySaleHouse\Controller\Admin\SaleHouseController',
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
                                        'controller' => 'Yu\RealtySaleHouse\Controller\Admin\SaleHouseController',
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
                                        'controller' => 'Yu\RealtySaleHouse\Controller\Admin\SaleHouseController',
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
                                        'controller' => 'Yu\RealtySaleHouse\Controller\Admin\SaleHouseController',
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
            'Yu\RealtySaleHouse\Controller\Admin\SaleHouseController' => Controller\Admin\Factory\SaleHouseControllerFactory::class,
        ],
    ],

    'realty' => [
        'sale-house' => [
            'name' => 'Sale house',
            'admin' => [
                'options' => [
                    'title' => 'Продажа домов',
                    'table' => 'realty-sale-house',
                    'form' => 'realty-sale-house',
                    'route' => 'admin/realty-sale-house',
                    'type' => 'sale-house',
                ],
            ],
            'attributes' => [
                'district' => [
                    'id' => 100,
                    'code' => 'district',
                    'label' => 'District',
                    'type' => 'int',
                ],
                'rooms' => [
                    'id' => 101,
                    'code' => 'rooms',
                    'label' => 'Rooms',
                    'type' => 'int',
                ],
                'area' => [
                    'id' => 202,
                    'code' => 'area',
                    'label' => 'Area house',
                    'type' => 'text',
                ],
                'area_land' => [
                    'id' => 203,
                    'code' => 'area_land',
                    'label' => 'Area land',
                    'type' => 'text',
                ],

                'comm' => [
                    'id' => 205,
                    'code' => 'comm',
                    'label' => 'Communications',
                    'type' => 'text',
                ],
                'status' => [
                    'id' => 106,
                    'code' => 'status',
                    'label' => 'Status',
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

    'eav' => [
        'value-option' => [
            'project' => [
                'id' => '101',
                'code' => 'project',
                'label' => 'Проекты домов',
            ],
        ],
    ],
];
