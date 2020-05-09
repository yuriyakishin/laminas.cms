<?php

declare(strict_types=1);

namespace Yu\Geo;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [

    'router' => [
        'routes' => [
            'admin' => [
                'child_routes' => [

                    'eav-value-option-district' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/eav/value-option/district',
                            'defaults' => [
                                'controller' => 'Yu\RealtySaleFlat\Comtroller\Admin\ValueOptionDistrictController',
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
                                        'controller' => 'Yu\RealtySaleFlat\Comtroller\Admin\ValueOptionDistrictController',
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
                                        'controller' => 'Yu\RealtySaleFlat\Comtroller\Admin\ValueOptionDistrictController',
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
                                        'controller' => 'Yu\RealtySaleFlat\Comtroller\Admin\ValueOptionDistrictController',
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
            'Yu\RealtySaleFlat\Comtroller\Admin\ValueOptionDistrictController' => Controller\Admin\Factory\ValueOptionDistrictControllerFactory::class,
        ],
    ],

    'controller_plugins' => [
        'factories' => [
            \Yu\Geo\Controller\Plugin\GeoManagerPlugin::class => \Yu\Geo\Controller\Plugin\Factory\GeoManagerPluginFactory::class,
        ],
        'aliases' => [
            'geoManager' => \Yu\Geo\Controller\Plugin\GeoManagerPlugin::class,
        ],
    ],

    'service_manager' => [
        'factories' => [
            \Yu\Geo\Service\GeoManager::class => \Yu\Geo\Service\Factory\GeoManagerFactory::class,
        ],
        'aliases' => [
            'geo.manager' => \Yu\Geo\Service\GeoManager::class,
        ]
    ],

    'view_manager' => [
        'template_map' => [
            'admin/geo/map' => __DIR__ . '/../view/templates/admin/geo/map.phtml',
        ],
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],

    'view_helpers' => [
        'factories' => [

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

    'eav' => [
        'value-option' => [
            'district' => [
                'id' => '100',
                'code' => 'district',
                'label' => 'Районы города',
            ],
        ],
    ],

];
