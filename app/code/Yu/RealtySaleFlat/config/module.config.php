<?php

declare(strict_types=1);

namespace Yu\RealtySaleFlat;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'sale-flat' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/sale-flat',
                    'defaults' => [
                        'controller' => 'Yu\RealtySaleFlat\Controller\SaleFlatController',
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
                                'controller' => 'Yu\RealtySaleFlat\Controller\SaleFlatController',
                                'action' => 'view',
                                'id' => '',
                            ],
                        ],
                    ],
                ],
            ],
            'admin' => [
                'child_routes' => [
                    'realty-sale-flat' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/realty/sale/flat',
                            'defaults' => [
                                'controller' => 'Yu\RealtySaleFlat\Controller\Admin\SaleFlatController',
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
                                        'controller' => 'Yu\RealtySaleFlat\Controller\Admin\SaleFlatController',
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
                                        'controller' => 'Yu\RealtySaleFlat\Controller\Admin\SaleFlatController',
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
                                        'controller' => 'Yu\RealtySaleFlat\Controller\Admin\SaleFlatController',
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
                                'controller' => 'Yu\RealtySaleFlat\Controller\Admin\ValueOptionProject',
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
                                        'controller' => 'Yu\RealtySaleFlat\Controller\Admin\ValueOptionProject',
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
                                        'controller' => 'Yu\RealtySaleFlat\Controller\Admin\ValueOptionProject',
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
                                        'controller' => 'Yu\RealtySaleFlat\Controller\Admin\ValueOptionProject',
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
            'Yu\RealtySaleFlat\Controller\SaleFlatController' => Controller\Factory\SaleFlatControllerFactory::class,

            'Yu\RealtySaleFlat\Controller\Admin\SaleFlatController' => Controller\Admin\Factory\SaleFlatControllerFactory::class,
            'Yu\RealtySaleFlat\Controller\Admin\ValueOptionProject' => Controller\Admin\Factory\ValueOptionProjectControllerFactory::class,
        ],
    ],

    'realty' => [
        'sale-flat' => [
            'name' => 'Sale flat',
            'admin' => [
                'options' => [
                    'title' => 'Продажа квартир',
                    'table' => 'realty-sale-flat',
                    'form' => 'realty-sale-flat',
                    'route' => 'admin/realty-sale-flat',
                    'type' => 'sale-flat',
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
