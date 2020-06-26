<?php

declare(strict_types=1);

namespace Yu\Eav;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [

    'service_manager' => [
        'factories' => [
            \Yu\Eav\Service\ValueOptionManager::class => function($container) {
                $config = $container->get('config');
                return new \Yu\Eav\Service\ValueOptionManager($config['eav']);
            },
        ],
        'aliases' => [
            'valueOptionManager' => \Yu\Eav\Service\ValueOptionManager::class,
        ]
    ],

    'controller_plugins' => [
        'factories' => [
            \Yu\Eav\Controller\Plugin\ValueOptionManagerPlugin::class => \Yu\Eav\Controller\Plugin\Factory\ValueOptionManagerPluginFactory::class,
        ],
        'aliases' => [
            'valueOptionManager' => \Yu\Eav\Controller\Plugin\ValueOptionManagerPlugin::class,
        ],
    ],

    'view_helpers' => [
        'factories' => [
            \Yu\Eav\View\Helper\ViewOptionHelper::class => \Yu\Eav\View\Helper\Factory\ViewOptionHelperFactory::class,
            \Yu\Eav\View\Helper\HandbookHelper::class => \Yu\Eav\View\Helper\Factory\HandbookHelperFactory::class,
        ],
        'aliases' => [
            'viewOption' => \Yu\Eav\View\Helper\ViewOptionHelper::class,
            'handbook' => \Yu\Eav\View\Helper\HandbookHelper::class,
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
