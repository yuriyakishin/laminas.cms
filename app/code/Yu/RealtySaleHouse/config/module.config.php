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
                                'controller' => 'Yu\RealtySaleHouse\Comtroller\Admin\SaleHouseController',
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
                                        'controller' => 'Yu\RealtySaleHouse\Comtroller\Admin\SaleHouseController',
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
                                        'controller' => 'Yu\RealtySaleHouse\Comtroller\Admin\SaleHouseController',
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
                                        'controller' => 'Yu\RealtySaleHouse\Comtroller\Admin\SaleHouseController',
                                        'action' => 'save',
                                    ],
                                ],
                            ],
                        ],
                    ],

                    'eav-value-option-project' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/eav/value-option/project',
                            'defaults' => [
                                'controller' => 'Yu\RealtySaleHouse\Comtroller\Admin\ValueOptionProject',
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
                                        'controller' => 'Yu\RealtySaleHouse\Comtroller\Admin\ValueOptionProject',
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
                                        'controller' => 'Yu\RealtySaleHouse\Comtroller\Admin\ValueOptionProject',
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
                                        'controller' => 'Yu\RealtySaleHouse\Comtroller\Admin\ValueOptionProject',
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
            'Yu\RealtySaleHouse\Comtroller\Admin\SaleHouseController' => Controller\Admin\Factory\SaleHouseControllerFactory::class,
            'Yu\RealtySaleHouse\Comtroller\Admin\ValueOptionProject' => Controller\Admin\Factory\ValueOptionProjectControllerFactory::class,
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
                'area_all' => [
                    'id' => 102,
                    'code' => 'area_all',
                    'label' => 'Area',
                    'type' => 'text',
                ],
                'area_live' => [
                    'id' => 103,
                    'code' => 'area_live',
                    'label' => 'Area live',
                    'type' => 'text',
                ],
                'area_kitchen' => [
                    'id' => 104,
                    'code' => 'area_kitchen',
                    'label' => 'Area kitchen',
                    'type' => 'text',
                ],
                'project' => [
                    'id' => 105,
                    'code' => 'project',
                    'label' => 'Project',
                    'type' => 'int',
                ],
                'status' => [
                    'id' => 106,
                    'code' => 'status',
                    'label' => 'Status',
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
