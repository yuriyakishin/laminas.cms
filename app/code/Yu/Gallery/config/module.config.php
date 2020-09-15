<?php

declare(strict_types=1);

namespace Yu\Gallery;

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
                    'gallery' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/gallery',
                            'defaults' => [
                                'controller' => Controller\Admin\GalleryController::class,
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
                                        'controller' => Controller\Admin\GalleryController::class,
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
                                        'controller' => Controller\Admin\GalleryController::class,
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
                                        'controller' => Controller\Admin\GalleryController::class,
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
            Controller\Admin\GalleryController::class => Controller\Admin\Factory\GalleryControllerFactory::class,
            Controller\GalleryController::class => InvokableFactory::class,
        ],
    ],

    'view_manager' => [
        'template_map' => [
            'admin/page' => __DIR__ . '/../view/admin/page/index.phtml',
            'yu/page' => __DIR__ . '/../view/frontend/page/page.phtml',
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
