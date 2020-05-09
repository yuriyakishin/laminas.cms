<?php

declare(strict_types=1);

namespace Yu\Price;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'admin' => [
                'child_routes' => [
                    'currency' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/currency',
                            'defaults' => [
                                'controller' => Controller\Admin\CurrencyController::class,
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
                                        'controller' => Controller\Admin\CurrencyController::class,
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
                                        'controller' => Controller\Admin\CurrencyController::class,
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
                                        'controller' => Controller\Admin\CurrencyController::class,
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
            Controller\Admin\CurrencyController::class => Controller\Admin\Factory\CurrencyControllerFactory::class,
        ],
    ],

    'controller_plugins' => [
        'factories' => [
            \Yu\Price\Controller\Plugin\PriceManagerPlugin::class => \Yu\Price\Controller\Plugin\Factory\PriceManagerPluginFactory::class,
        ],
        'aliases' => [
            'priceManager' => \Yu\Price\Controller\Plugin\PriceManagerPlugin::class,
        ],
    ],

    'service_manager' => [
        'factories' => [
            \Yu\Price\Service\PriceManager::class => \Yu\Price\Service\Factory\PriceManagerFactory::class,
        ],
        'aliases' => [
            'price.manager' => \Yu\Price\Service\PriceManager::class,
            'priceManager' => \Yu\Price\Service\PriceManager::class,
        ]
    ],

    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ],
            ],
        ],
    ],
];
