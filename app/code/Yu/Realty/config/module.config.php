<?php

declare(strict_types=1);

namespace Yu\Realty;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'admin' => [
                'child_routes' => [
                    'agent' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/agent',
                            'defaults' => [
                                'controller' => Controller\Admin\AgentController::class,
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
                                        'controller' => Controller\Admin\AgentController::class,
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
                                        'controller' => Controller\Admin\AgentController::class,
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
                                        'controller' => Controller\Admin\AgentController::class,
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
            Controller\Admin\AgentController::class => Controller\Admin\Factory\AgentControllerFactory::class,
        ],
    ],

    'service_manager' => [
        'factories' => [
            \Yu\Realty\Service\RealtyManager::class => \Yu\Realty\Service\Factory\RealtyManagerFactory::class,
            \Yu\Realty\Service\RealtyConfigManager::class => function($container) {
                $config = $container->get('config');
                return new \Yu\Realty\Service\RealtyConfigManager($config['realty']);
            },
        ],
        'aliases' => [
            'realty.manager' => \Yu\Realty\Service\RealtyManager::class,
            'realty.config.manager' => \Yu\Realty\Service\RealtyConfigManager::class,
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
