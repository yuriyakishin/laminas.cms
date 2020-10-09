<?php

declare(strict_types=1);

namespace Yu\RealtySaleCommercial;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'sale-commercial' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/sale-commercial',
                    'defaults' => [
                        'controller' => 'Yu\RealtySaleCommercial\Controller\SaleCommercialController',
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
                                'controller' => 'Yu\RealtySaleCommercial\Controller\SaleCommercialController',
                                'action' => 'view',
                                'id' => '',
                            ],
                        ],
                    ],
                ],
            ],

            'admin' => [
                'child_routes' => [
                    'realty-sale-commercial' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/realty/sale/commercial',
                            'defaults' => [
                                'controller' => 'Yu\RealtySaleCommercial\Controller\Admin\SaleCommercialController',
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
                                        'controller' => 'Yu\RealtySaleCommercial\Controller\Admin\SaleCommercialController',
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
                                        'controller' => 'Yu\RealtySaleCommercial\Controller\Admin\SaleCommercialController',
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
                                        'controller' => 'Yu\RealtySaleCommercial\Controller\Admin\SaleCommercialController',
                                        'action' => 'save',
                                    ],
                                ],
                            ],
                        ],
                    ],

                    'eav-value-option-commercial' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/eav/value-option/commercial',
                            'defaults' => [
                                'controller' => 'Yu\RealtySaleCommercial\Controller\Admin\ValueOptionCommercial',
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
                                        'controller' => 'Yu\RealtySaleCommercial\Controller\Admin\ValueOptionCommercial',
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
                                        'controller' => 'Yu\RealtySaleCommercial\Controller\Admin\ValueOptionCommercial',
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
                                        'controller' => 'Yu\RealtySaleCommercial\Controller\Admin\ValueOptionCommercial',
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
            'Yu\RealtySaleCommercial\Controller\SaleCommercialController' => Controller\Factory\SaleCommercialControllerFactory::class,

            'Yu\RealtySaleCommercial\Controller\Admin\SaleCommercialController' => Controller\Admin\Factory\SaleCommercialControllerFactory::class,
            'Yu\RealtySaleCommercial\Controller\Admin\ValueOptionCommercial' => Controller\Admin\Factory\ValueOptionCommercialControllerFactory::class,
        ],
    ],

    'realty' => [
        'sale-commercial' => [
            'name' => 'Sale Commercial',
            'admin' => [
                'options' => [
                    'title' => 'Продажа коммерческой недвижимости',
                    'table' => 'realty-sale-commercial',
                    'form' => 'realty-sale-commercial',
                    'route' => 'admin/realty-sale-commercial',
                    'type' => 'sale-commercial',
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
                'commercial' => [
                    'id' => 301,
                    'code' => 'commercial',
                    'label' => 'Тип',
                    'type' => 'int',
                    'options' => true,
                ],
                'area' => [
                    'id' => 302,
                    'code' => 'area',
                    'label' => 'Площадь',
                    'type' => 'text',
                ],
                'area_land' => [
                    'id' => 303,
                    'code' => 'area_land',
                    'label' => 'Площадб земли',
                    'type' => 'text',
                ],
                'parking' => [
                    'id' => 304,
                    'code' => 'parking',
                    'label' => 'Паркинг',
                    'type' => 'text',
                ],
                'status' => [
                    'id' => 106,
                    'code' => 'status',
                    'label' => 'Юридический статус',
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
                'catalog' => 'Продажа коммерческой недвижимости',
                'view' => 'Продается %s',
                'item' => 'Продается %s',
            ],

            'repository' => [
                'realty-repository' => Repository\SaleCommercialRepository::class,
                'criterial-bilder' => Repository\SearchCriteriaBuilder::class,
            ],

        ],
    ],

    'eav' => [
        'value-option' => [
            'commercial' => [
                'id' => '301',
                'code' => 'commercial',
                'label' => 'Виды коммерческой недвижимости',
            ],
        ],
    ],
];
