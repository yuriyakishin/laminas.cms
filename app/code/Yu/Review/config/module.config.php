<?php

declare(strict_types=1);

namespace Yu\Review;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Laminas\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory;

return [
    'router' => [
        'routes' => [
            'review' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/review',
                    'defaults' => [
                        'controller' => Controller\ReviewController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'admin' => [
                'child_routes' => [
                    'review' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/review',
                            'defaults' => [
                                'controller' => Controller\Admin\ReviewController::class,
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
                                        'controller' => Controller\Admin\ReviewController::class,
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
                                        'controller' => Controller\Admin\ReviewController::class,
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
                                        'controller' => Controller\Admin\ReviewController::class,
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
            Controller\ReviewController::class => InvokableFactory::class,
            Controller\Admin\ReviewController::class => InvokableFactory::class,
        ],
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
