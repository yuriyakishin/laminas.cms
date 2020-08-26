<?php

declare(strict_types=1);

namespace Yu\Eav;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [

    'service_manager' => [
        'factories' => [
            \Yu\Eav\Service\ValueOptionManager::class => function ($container) {
                $config = $container->get('config');
                return new \Yu\Eav\Service\ValueOptionManager($config['eav']);
            },
            \Yu\Eav\Service\EavManager::class => \Yu\Eav\Service\Factory\EavManagerFactory::class,
        ],
        'aliases' => [
            'valueOptionManager' => \Yu\Eav\Service\ValueOptionManager::class,
            'eavManager' => \Yu\Eav\Service\EavManager::class,
        ]
    ],

    'controller_plugins' => [
        'factories' => [
            \Yu\Eav\Controller\Plugin\ValueOptionManagerPlugin::class => \Yu\Eav\Controller\Plugin\Factory\ValueOptionManagerPluginFactory::class,
            \Yu\Eav\Controller\Plugin\EavManagerPlugin::class => \Yu\Eav\Controller\Plugin\Factory\EavManagerPluginFactory::class,
        ],
        'aliases' => [
            'valueOptionManager' => \Yu\Eav\Controller\Plugin\ValueOptionManagerPlugin::class,
            'eavManager' => \Yu\Eav\Controller\Plugin\EavManagerPlugin::class,
            'eav' => \Yu\Eav\Controller\Plugin\EavManagerPlugin::class,
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

    'eav' => [
        'class' => [
            'int' => \Yu\Eav\Entity\EavValueInt::class,
            'text' => \Yu\Eav\Entity\EavValueText::class,
        ],
    ],

];
