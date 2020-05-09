<?php

declare(strict_types=1);

namespace Yu\User;

use Laminas\Router\Http\Literal;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Laminas\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory;

return [
    'router' => [
        'routes' => [
            'admin' => [
                'child_routes' => [
                    'profile' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/profile',
                            'defaults' => [
                                'controller' => Controller\Admin\ProfileController::class,
                                'action' => 'index',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'save' => [
                                'type' => Literal::class,
                                'options' => [
                                    'route' => '/save',
                                    'defaults' => [
                                        'controller' => Controller\Admin\ProfileController::class,
                                        'action' => 'save',
                                    ],
                                ],
                            ],
                        ],
                    ]
                ]
            ],
        ],
    ],

    'controllers' => [
        'factories' => [
            Controller\Admin\ProfileController::class => Controller\Admin\Factory\ProfileControllerFactory::class,
        ],
    ],

    'service_manager' => [
        'factories' => [
            Repository\UserRepository::class => ReflectionBasedAbstractFactory::class,
        ],
    ],

    'view_manager' => [
        'template_map' => [
            'admin/user/profile' => __DIR__ . '/../view/templates/admin/user/profile.phtml',
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
