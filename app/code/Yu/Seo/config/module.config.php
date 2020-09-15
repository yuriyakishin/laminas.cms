<?php

declare(strict_types=1);

namespace Yu\Seo;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [

    'view_helpers' => [
        'factories' => [
            \Yu\Seo\View\Helper\SeoHelper::class => function ($container) {
                $entityManager = $container->get('doctrine.entitymanager.orm_default');
                return new \Yu\Seo\View\Helper\SeoHelper($entityManager);
            },
        ],
        'aliases' => [
            'seo' => \Yu\Seo\View\Helper\SeoHelper::class,
        ],
    ],

    'view_manager' => [
        'template_map' => [
            'yu/seo/meta' => __DIR__ . '/../view/templates/meta.phtml',
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
