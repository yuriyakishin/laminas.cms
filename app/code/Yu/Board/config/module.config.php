<?php

declare(strict_types=1);

namespace Yu\Board;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Laminas\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory;

return [
    'router' => [
        'routes' => [
            'board' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/board',
                    'defaults' => [
                        'controller' => Controller\BoardController::class,
                        'action' => 'index',
                        'page' => 1,
                        'type' => '',
                        'city' => '',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'form' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/form',
                            'defaults' => [
                                'controller' => Controller\BoardController::class,
                                'action' => 'form',
                            ],
                        ],
                    ],
                    'send' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/send',
                            'defaults' => [
                                'controller' => Controller\BoardController::class,
                                'action' => 'send',
                            ],
                        ],
                    ],
                ],
            ],
            'admin' => [
                'child_routes' => [
                    'board' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/board',
                            'defaults' => [
                                'controller' => Controller\Admin\BoardController::class,
                                'action' => 'index',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'ajax' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => '/ajax',
                                    'defaults' => [
                                        'controller' => Controller\Admin\BoardController::class,
                                        'action' => 'ajax',
                                        'id' => 0,
                                    ],
                                ],
                            ],
                            'edit' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => '/edit[/:id]',
                                    'defaults' => [
                                        'controller' => Controller\Admin\BoardController::class,
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
                                        'controller' => Controller\Admin\BoardController::class,
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
                                        'controller' => Controller\Admin\BoardController::class,
                                        'action' => 'save',
                                    ],
                                ],
                            ],
                        ],
                    ],

                    'board-city' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/board-city',
                            'defaults' => [
                                'controller' => Controller\Admin\BoardCityController::class,
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
                                        'controller' => Controller\Admin\BoardCityController::class,
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
                                        'controller' => Controller\Admin\BoardCityController::class,
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
                                        'controller' => Controller\Admin\BoardCityController::class,
                                        'action' => 'save',
                                    ],
                                ],
                            ],
                        ],
                    ],

                    'board-type' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/board-type',
                            'defaults' => [
                                'controller' => Controller\Admin\BoardTypeController::class,
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
                                        'controller' => Controller\Admin\BoardTypeController::class,
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
                                        'controller' => Controller\Admin\BoardTypeController::class,
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
                                        'controller' => Controller\Admin\BoardTypeController::class,
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
            Controller\Admin\BoardController::class => InvokableFactory::class,
            Controller\Admin\BoardCityController::class => InvokableFactory::class,
            Controller\Admin\BoardTypeController::class => InvokableFactory::class,
            Controller\BoardController::class => InvokableFactory::class,
        ],
    ],

    'view_manager' => [
        'template_map' => [
            'yu/board' => __DIR__ . '/../view/frontend/templates/board/index.phtml',
        ],
    ],

    'view_helpers' => [
        'factories' => [
            \Yu\Board\View\Helper\BoardHelper::class => \Yu\Board\View\Helper\Factory\BoardHelperFactory::class,
        ],
        'aliases' => [
            'board' => \Yu\Board\View\Helper\BoardHelper::class,
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
