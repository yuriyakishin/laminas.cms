<?php

declare(strict_types=1);

namespace Yu\RealtyRentFlat;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'rent-flat' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/rent-flat',
                    'defaults' => [
                        'controller' => 'Yu\RealtyRentFlat\Controller\RentFlatController',
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
                                'controller' => 'Yu\RealtyRentFlat\Controller\RentFlatController',
                                'action' => 'view',
                                'id' => '',
                            ],
                        ],
                    ],
                ],
            ],
            'admin' => [
                'child_routes' => [
                    'realty-rent-flat' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/realty/rent/flat',
                            'defaults' => [
                                'controller' => 'Yu\RealtyRentFlat\Controller\Admin\RentFlatController',
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
                                        'controller' => 'Yu\RealtyRentFlat\Controller\Admin\RentFlatController',
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
                                        'controller' => 'Yu\RealtyRentFlat\Controller\Admin\RentFlatController',
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
                                        'controller' => 'Yu\RealtyRentFlat\Controller\Admin\RentFlatController',
                                        'action' => 'save',
                                    ],
                                ],
                            ],
                        ],
                    ],

                    'eav-value-option-class' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/eav/value-option/class',
                            'defaults' => [
                                'controller' => 'Yu\RealtyRentFlat\Controller\Admin\ValueOptionClass',
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
                                        'controller' => 'Yu\RealtyRentFlat\Controller\Admin\ValueOptionClass',
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
                                        'controller' => 'Yu\RealtyRentFlat\Controller\Admin\ValueOptionClass',
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
                                        'controller' => 'Yu\RealtyRentFlat\Controller\Admin\ValueOptionClass',
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
            'Yu\RealtyRentFlat\Controller\RentFlatController' => Controller\Factory\RentFlatControllerFactory::class,

            'Yu\RealtyRentFlat\Controller\Admin\RentFlatController' => Controller\Admin\Factory\RentFlatControllerFactory::class,
            'Yu\RealtyRentFlat\Controller\Admin\ValueOptionClass' => Controller\Admin\Factory\ValueOptionClassControllerFactory::class,
        ],
    ],

    'realty' => [
        'rent-flat' => [
            'name' => 'rent flat',
            'admin' => [
                'options' => [
                    'title' => 'Аренда квартир',
                    'table' => 'realty-rent-flat',
                    'form' => 'realty-rent-flat',
                    'route' => 'admin/realty-rent-flat',
                    'type' => 'rent-flat',
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
                    'options' => true,
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
                'catalog' => 'Аренда квартир',
                'view' => 'Сдается %s-комнатная квартира',
                'item' => 'Сдается квартира',
            ],

            'repository' => [
                'realty-repository' => Repository\RentFlatRepository::class,
                'criterial-bilder' => Repository\SearchCriteriaBuilder::class,
            ],
        ],
    ],

    'eav' => [
        'value-option' => [
            'class' => [
                'id' => '501',
                'code' => 'class',
                'label' => 'Класс аренды',
            ],
        ],
    ],

];
