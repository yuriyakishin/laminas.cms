<?php

declare(strict_types=1);

namespace Yu\Catalog;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Laminas\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory;

return [
    'router' => [
        'routes' => [
            'buy' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/buy',
                    'defaults' => [
                        'controller' => Controller\BuyController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'admin' => [
                'child_routes' => [

                    'catalog' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/catalog',
                            'defaults' => [
                                'controller' => Controller\Admin\CatalogController::class,
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
                                        'controller' => Controller\Admin\CatalogController::class,
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
                                        'controller' => Controller\Admin\CatalogController::class,
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
                                        'controller' => Controller\Admin\CatalogController::class,
                                        'action' => 'save',
                                    ],
                                ],
                            ],
                        ],
                    ],

                    'eav-value-option-catalog-category' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/eav/value-option/catalog-category',
                            'defaults' => [
                                'controller' => 'Yu\Catalog\Controller\Admin\ValueOptionCategory',
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
                                        'controller' => 'Yu\Catalog\Controller\Admin\ValueOptionCategory',
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
                                        'controller' => 'Yu\Catalog\Controller\Admin\ValueOptionCategory',
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
                                        'controller' => 'Yu\Catalog\Controller\Admin\ValueOptionCategory',
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
            Controller\BuyController::class => InvokableFactory::class,
            Controller\Admin\CatalogController::class => InvokableFactory::class,
            Controller\CatalogController::class => InvokableFactory::class,
            'Yu\Catalog\Controller\Admin\ValueOptionCategory' => Controller\Admin\Factory\ValueOptionCaregoryControllerFactory::class,
        ],
    ],

    'view_manager' => [
        'template_map' => [

        ],
    ],

    'view_helpers' => [
        'factories' => [
            \Yu\Catalog\View\Helper\CatalogHelper::class => \Yu\Catalog\View\Helper\Factory\CatalogHelperFactory::class,
        ],
        'aliases' => [
            'catalogHelper' => \Yu\Catalog\View\Helper\CatalogHelper::class,
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
            'catalog-category' => [
                'id' => 901,
                'code' => 'catalog-category',
                'label' => 'Рубрики для объявлений "Купим/Снимем"',
            ],
        ],
        'attribute' => [
            'catalog-category' => [
                'id' => 901,
                'code' => 'category_id',
                'label' => 'Рубрики для объявлений "Купим/Снимем"',
                'type' => 'int',
            ],
            'catalog-phone' => [
                'id' => 902,
                'code' => 'phone',
                'label' => 'Телефон',
                'type' => 'text',
            ],
            'catalog-email' => [
                'id' => 903,
                'code' => 'email',
                'label' => 'Email',
                'type' => 'text',
            ],
        ],
        'attribute-set' => [
            'catalog' => [
                [
                    'attribute' => 'catalog-category',
                    'sort' => 100,
                ],
                [
                    'attribute' => 'catalog-phone',
                    'sort' => 100,
                ],
                [
                    'attribute' => 'catalog-email',
                    'sort' => 100,
                ],
            ],
        ],
    ],
];
