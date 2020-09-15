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
            \Yu\Core\Controller\Plugin\ConfigPlugin::class => function ($container) {
                $config = $container->get('Config');
                return new \Yu\Core\Controller\Plugin\ConfigPlugin($config);
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
            'config' => \Yu\Core\Controller\Plugin\ConfigPlugin::class,
        ],
    ],

    'view_helpers' => [
        'factories' => [
            \Yu\Core\View\Helper\LangHelper::class => InvokableFactory::class,
            \Yu\Core\View\Helper\BreadcrumbsHelper::class => InvokableFactory::class,
            \Yu\Core\View\Helper\UrlWithLang::class => \Yu\Core\View\Helper\Factory\UrlWithLangFactory::class,
        ],
        'aliases' => [
            'lang' => \Yu\Core\View\Helper\LangHelper::class,
            'breadcrumbs' => \Yu\Core\View\Helper\BreadcrumbsHelper::class,
            'urlWithLang' => \Yu\Core\View\Helper\UrlWithLang::class,
            'urlLang' => \Yu\Core\View\Helper\UrlWithLang::class,
        ],
    ],

    'form_elements' => [
        'factories' => [
            'YuSelect' => \Yu\Core\Form\Element\Factory\ElementFactory::class,
        ],
    ],
];
