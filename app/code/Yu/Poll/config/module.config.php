<?php

declare(strict_types=1);

namespace Yu\Poll;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Laminas\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory;
use Laminas\View\View;

return [
    'router' => [
        'routes' => [
            'poll' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/poll',
                    'defaults' => [
                        'controller' => Controller\PollController::class,
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'send' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/send',
                            'defaults' => [
                                'controller' => Controller\PollController::class,
                                'action' => 'send',
                            ],
                        ],
                    ],
                ],
            ],
            'admin' => [
                'child_routes' => [
                    'poll' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/poll',
                            'defaults' => [
                                'controller' => Controller\Admin\PollController::class,
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
                                        'controller' => Controller\Admin\PollController::class,
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
                                        'controller' => Controller\Admin\PollController::class,
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
                                        'controller' => Controller\Admin\PollController::class,
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
            Controller\Admin\PollController::class => InvokableFactory::class,
            Controller\PollController::class => InvokableFactory::class,
        ],
    ],

    'view_helpers' => [
        'factories' => [
            \Yu\Poll\View\Helper\PollHelper::class => \Yu\Poll\View\Helper\Factory\PollHelperFactory::class,
        ],
        'aliases' => [
            'poll' => \Yu\Poll\View\Helper\PollHelper::class,
        ],
    ],

    'view_manager' => [
        'template_map' => [
            'yu/poll/block/block' => __DIR__ . '/../view/templates/block/block.phtml',
            'yu/poll/block/poll' => __DIR__ . '/../view/templates/block/poll.phtml',
            'yu/poll/block/result' => __DIR__ . '/../view/templates/block/result.phtml',
            'yu/poll' => __DIR__ . '/../view/templates/poll.phtml',
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
