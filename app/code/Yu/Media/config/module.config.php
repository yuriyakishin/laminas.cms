<?php

declare(strict_types=1);

namespace Yu\Media;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [

    'router' => [
        'routes' => [
            'admin' => [
                'child_routes' => [
                    'image' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/image',
                            'defaults' => [
                                'controller' => Controller\Admin\ImageController::class,
                                'action' => 'index',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'upload' => [
                                'type' => Literal::class,
                                'options' => [
                                    'route' => '/upload',
                                    'defaults' => [
                                        'controller' => Controller\Admin\ImageController::class,
                                        'action' => 'upload',
                                    ],
                                ],
                            ],
                            'delete' => [
                                'type' => Literal::class,
                                'options' => [
                                    'route' => '/delete',
                                    'defaults' => [
                                        'controller' => Controller\Admin\ImageController::class,
                                        'action' => 'delete',
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
            Controller\Admin\ImageController::class => InvokableFactory::class,
        ],
    ],

    'controller_plugins' => [
        'factories' => [
            \Yu\Media\Controller\Plugin\ImageManagerPlugin::class => \Yu\Media\Controller\Plugin\Factory\ImageManagerPluginFactory::class,
        ],
        'aliases' => [
            'imageManager' => \Yu\Media\Controller\Plugin\ImageManagerPlugin::class,
        ],
    ],

    'service_manager' => [
        'factories' => [
            \Yu\Media\Service\ImageManager::class => \Yu\Media\Service\Factory\ImageManagerFactory::class,
        ],
        'aliases' => [
            'imageManager' => \Yu\Media\Service\ImageManager::class,
            'ImageManager' => \Yu\Media\Service\ImageManager::class,
        ],
        'shared' => [
            \Yu\Media\Service\ImageManager::class,
        ],
    ],

    'view_manager' => [
        'template_map' => [
            'admin/media/images' => __DIR__ . '/../view/templates/admin/media/images.phtml',
        ],
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],

    'view_helpers' => [
        'factories' => [
            \Yu\Media\View\Helper\PreviewHelper::class => \Yu\Media\View\Helper\Factory\PreviewHelperFactory::class,
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
