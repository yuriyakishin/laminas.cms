<?php

declare(strict_types=1);

namespace Yu\Core;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'controller_plugins' => [
        'factories' => [
            \Yu\Core\Controller\Plugin\EntityManagerPlugin::class => function ($container) {
                $entitymanager = $container->get('doctrine.entitymanager.orm_default');
                return new \Yu\Core\Controller\Plugin\EntityManagerPlugin($entitymanager);
            },
            \Yu\Core\Controller\Plugin\NavigationPlugin::class => function ($container) {
                $navigation = $container->get('Laminas\Navigation\Pages');
                return new \Yu\Core\Controller\Plugin\NavigationPlugin($navigation);
            },
        ],
        'aliases' => [
            'entityManager' => \Yu\Core\Controller\Plugin\EntityManagerPlugin::class,
            'getEntityManager' => \Yu\Core\Controller\Plugin\EntityManagerPlugin::class,
            'navigation' => \Yu\Core\Controller\Plugin\NavigationPlugin::class,
        ],
    ],

    'view_helpers' => [
        'factories' => [
            \Yu\Core\View\Helper\LangHelper::class => InvokableFactory::class,
            \Yu\Core\View\Helper\BreadcrumbsHelper::class => InvokableFactory::class,
        ],
        'aliases' => [
            'lang' => \Yu\Core\View\Helper\LangHelper::class,
            'breadcrumbs' => \Yu\Core\View\Helper\BreadcrumbsHelper::class,
        ],
    ],

    'form_elements' => [
        'factories' => [
            'YuSelect' => \Yu\Core\Form\Element\Factory\ElementFactory::class,
        ],
    ],
];
