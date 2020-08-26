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
                'floor' => [
                    'id' => 111,
                    'code' => 'floor',
                    'label' => 'Этаж',
                    'type' => 'text',
                ],
                'floors' => [
                    'id' => 112,
                    'code' => 'floors',
                    'label' => 'Этажность',
                    'type' => 'text',
                ],
                'area_all' => [
                    'id' => 102,
                    'code' => 'area_all',
                    'label' => 'Общая площадь',
                    'type' => 'text',
                ],
                'area_live' => [
                    'id' => 103,
                    'code' => 'area_live',
                    'label' => 'Жилая площадь',
                    'type' => 'text',
                ],
                'area_kitchen' => [
                    'id' => 104,
                    'code' => 'area_kitchen',
                    'label' => 'Площадь кухни',
                    'type' => 'text',
                ],
                'project' => [
                    'id' => 105,
                    'code' => 'project',
                    'label' => 'Проект дома',
                    'type' => 'int',
                    'options' => true,
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
                'catalog' => 'Продажа квартир',
                'view' => 'Продается %s-комнатная квартира',
                'item' => 'Продается квартира',
            ],

            'repository' => [
                'realty-repository' => \Yu\RealtySaleFlat\Repository\SaleFlatRepository::class,
                'criterial-bilder' => \Yu\RealtySaleFlat\Repository\SearchCriteriaBuilder::class,
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
