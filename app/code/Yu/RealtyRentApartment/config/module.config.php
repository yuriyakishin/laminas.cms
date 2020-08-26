<?php

declare(strict_types=1);

namespace Yu\RealtyRentApartment;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'rent-apartment' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/rent-apartment',
                    'defaults' => [
                        'controller' => 'Yu\RealtyRentApartment\Controller\RentApartmentController',
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
                                'controller' => 'Yu\RealtyRentApartment\Controller\RentApartmentController',
                                'action' => 'view',
                                'id' => '',
                            ],
                        ],
                    ],
                ],
            ],
            'admin' => [
                'child_routes' => [
                    'realty-rent-apartment' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/realty/rent/apartment',
                            'defaults' => [
                                'controller' => 'Yu\RealtyRentApartment\Controller\Admin\RentApartmentController',
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
                                        'controller' => 'Yu\RealtyRentApartment\Controller\Admin\RentApartmentController',
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
                                        'controller' => 'Yu\RealtyRentApartment\Controller\Admin\RentApartmentController',
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
                                        'controller' => 'Yu\RealtyRentApartment\Controller\Admin\RentApartmentController',
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
            'Yu\RealtyRentApartment\Controller\RentApartmentController' => Controller\Factory\RentApartmentControllerFactory::class,

            'Yu\RealtyRentApartment\Controller\Admin\RentApartmentController' => Controller\Admin\Factory\RentApartmentControllerFactory::class,
            'Yu\RealtyRentApartment\Controller\Admin\ValueOptionClass' => Controller\Admin\Factory\ValueOptionClassControllerFactory::class,
        ],
    ],

    'realty' => [
        'rent-apartment' => [
            'name' => 'rent apartment',
            'admin' => [
                'options' => [
                    'title' => 'Аренда посуточно',
                    'table' => 'realty-rent-apartment',
                    'form' => 'realty-rent-apartment',
                    'route' => 'admin/realty-rent-apartment',
                    'type' => 'rent-apartment',
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
                'class' => [
                    'id' => 501,
                    'code' => 'class',
                    'label' => 'Класс аренды',
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

            'labels' => [
                'catalog' => 'Аренда посуточно',
                'view' => 'Сдается посуточно',
                'item' => 'Сдается посуточно',
            ],

            'repository' => [
                'realty-repository' => Repository\RentApartmentRepository::class,
                'criterial-bilder' => Repository\SearchCriteriaBuilder::class,
            ],
        ],
    ],

];
