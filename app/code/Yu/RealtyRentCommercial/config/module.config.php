<?php

declare(strict_types=1);

namespace Yu\RealtyRentCommercial;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'rent-commercial' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/rent-commercial',
                    'defaults' => [
                        'controller' => 'Yu\RealtyRentCommercial\Controller\RentCommercialController',
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
                                'controller' => 'Yu\RealtyRentCommercial\Controller\RentCommercialController',
                                'action' => 'view',
                                'id' => '',
                            ],
                        ],
                    ],
                ],
            ],
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
            'Yu\RealtyRentCommercial\Controller\RentCommercialController' => Controller\Factory\RentCommercialControllerFactory::class,
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
                    'label' => 'Площадь участка',
                    'type' => 'text',
                ],
                'parking' => [
                    'id' => 304,
                    'code' => 'parking',
                    'label' => 'Паркинг',
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
                'catalog' => 'Аренда коммерческой недвижимости',
                'view' => 'Сдается %s',
                'item' => 'Сдается %s',
            ],

            'repository' => [
                'realty-repository' => Repository\RentCommercialRepository::class,
                'criterial-bilder' => Repository\SearchCriteriaBuilder::class,
            ],
        ],
    ],
];
