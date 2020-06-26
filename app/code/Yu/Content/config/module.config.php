<?php

declare(strict_types=1);

namespace Yu\Content;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\Router\RouteInvokableFactory;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Laminas\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory;

return [

    'router' => [
        'routes' => [

            'admin' => [
                'child_routes' => [
                    'page' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/page',
                            'defaults' => [
                                'controller' => Controller\Admin\PageController::class,
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
                                        'controller' => Controller\Admin\PageController::class,
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
                                        'controller' => Controller\Admin\PageController::class,
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
                                        'controller' => Controller\Admin\PageController::class,
                                        'action' => 'save',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'block' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/block',
                            'defaults' => [
                                'controller' => Controller\Admin\BlockController::class,
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
                                        'controller' => Controller\Admin\BlockController::class,
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
                                        'controller' => Controller\Admin\BlockController::class,
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
                                        'controller' => Controller\Admin\BlockController::class,
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
            Controller\Admin\PageController::class => Controller\Admin\Factory\PageControllerFactory::class,
            Controller\Admin\BlockController::class => Controller\Admin\Factory\BlockControllerFactory::class,
            Controller\PageController::class => InvokableFactory::class,
        ],
    ],

    'view_manager' => [
        'template_map' => [
            'admin/page' => __DIR__ . '/../view/admin/page/index.phtml',
            'yu/page' => __DIR__ . '/../view/frontend/page/page.phtml',
        ],
    ],

    'view_helpers' => [
        'factories' => [
            \Yu\Content\View\Helper\ContentHelper::class => \Yu\Content\View\Helper\Factory\ContentHelperFactory::class,
        ],
        'aliases' => [
            'content' => \Yu\Content\View\Helper\ContentHelper::class,
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
