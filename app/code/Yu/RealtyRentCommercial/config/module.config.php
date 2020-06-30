<?php

declare(strict_types=1);

namespace Yu\RealtyRentCommercial;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'admin' => [
                'child_routes' => [
                    'realty-rent-commercial' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/realty/rent/commercial',
                            'defaults' => [
                                'controller' => 'Yu\RealtyRentCommercial\Controller\Admin\RentCommercialController',
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
                                        'controller' => 'Yu\RealtyRentCommercial\Controller\Admin\RentCommercialController',
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
                                        'controller' => 'Yu\RealtyRentCommercial\Controller\Admin\RentCommercialController',
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
                                        'controller' => 'Yu\RealtyRentCommercial\Controller\Admin\RentCommercialController',
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
            'Yu\RealtyRentCommercial\Controller\Admin\RentCommercialController' => Controller\Admin\Factory\RentCommercialControllerFactory::class,
        ],
    ],

    'realty' => [
        'rent-commercial' => [
            'name' => 'rent Commercial',
            'admin' => [
                'options' => [
                    'title' => 'Аренда коммерческой недвижимости',
                    'table' => 'realty-rent-commercial',
                    'form' => 'realty-rent-commercial',
                    'route' => 'admin/realty-rent-commercial',
                    'type' => 'rent-commercial',
                ],
            ],
            'attributes' => [
                'district' => [
                    'id' => 100,
                    'code' => 'district',
                    'label' => 'District',
                    'type' => 'int',
                ],
                'commercial' => [
                    'id' => 301,
                    'code' => 'commercial',
                    'label' => 'Commercial type',
                    'type' => 'int',
                ],
                'area' => [
                    'id' => 302,
                    'code' => 'area',
                    'label' => 'Area',
                    'type' => 'text',
                ],
                'area_land' => [
                    'id' => 303,
                    'code' => 'area_land',
                    'label' => 'Area land',
                    'type' => 'text',
                ],
                'parking' => [
                    'id' => 304,
                    'code' => 'parking',
                    'label' => 'Parking',
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
