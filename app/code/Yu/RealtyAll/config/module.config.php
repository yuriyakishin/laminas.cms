<?php

declare(strict_types=1);

namespace Yu\RealtyAll;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'realty' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/realty',
                    'defaults' => [
                        'controller' => 'Yu\RealtyAll\Controller\RealtyAllController',
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
                                'controller' => 'Yu\RealtyAll\Controller\RealtyAllController',
                                'action' => 'view',
                                'id' => '',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],

    'controllers' => [
        'factories' => [
            'Yu\RealtyAll\Controller\RealtyAllController' => Controller\Factory\RealtyAllControllerFactory::class,
        ],
    ],

    'realty' => [
        'all' => [
            'name' => '',

            'labels' => [
                'catalog' => 'Продажа квартир',
                'view' => 'Продается %s-комнатная квартира',
                'item' => 'Продается квартира',
            ],
        ],
    ],
];
