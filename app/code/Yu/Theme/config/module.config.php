<?php

declare(strict_types=1);

namespace Yu\Theme;

use Laminas\Router\Http\Literal;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'photogallery' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/photogallery',
                    'defaults' => [
                        'controller' => 'Yu\Theme\Controller\PhotogalleryController',
                        'action' => 'index',
                    ],
                ],
            ],
            'plan' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/plan',
                    'defaults' => [
                        'controller' => 'Yu\Theme\Controller\PlanController',
                        'action' => 'index',
                    ],
                ],
            ],
            'awards' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/about/awards',
                    'defaults' => [
                        'controller' => 'Yu\Theme\Controller\AwardsController',
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],

    'controllers' => [
        'factories' => [
            'Yu\Theme\Controller\PhotogalleryController' => function($container) {
                $options['identifier'] = 'photogallery';
                $options['template'] = 'yu/gallery/photogallery';
                $options['count'] = 20;
                return new \Yu\Gallery\Controller\GalleryController($options);
            },
            'Yu\Theme\Controller\PlanController' => function($container) {
                $options['identifier'] = 'plan';
                $options['template'] = 'yu/gallery/plan';
                $options['count'] = 1000;
                return new \Yu\Gallery\Controller\GalleryController($options);
            },
            'Yu\Theme\Controller\AwardsController' => function($container) {
                $options['identifier'] = 'awards';
                $options['template'] = 'yu/gallery/awards';
                $options['count'] = 1000;
                return new \Yu\Gallery\Controller\GalleryController($options);
            },
        ],
    ],

    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => [
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'layout/menu-top' => __DIR__ . '/../view/layout/menu-top.phtml',
            'layout/breadcrumbs' => __DIR__ . '/../view/layout/breadcrumbs.phtml',
            'layout/paginator' => __DIR__ . '/../view/layout/paginator.phtml',
            'layout/search' => __DIR__ . '/../view/layout/search.phtml',
            'layout/scripts' => __DIR__ . '/../view/layout/scripts.phtml',
            'layout/not-found-realty' => __DIR__ . '/../view/layout/not-found-realty.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',

            'yu/index' => __DIR__ . '/../view/templates/index/index.phtml',
            'yu/page' => __DIR__ . '/../view/templates/page/page.phtml',
            'yu/page/contacts' => __DIR__ . '/../view/templates/page/contacts.phtml',
            'yu/page/estimate' => __DIR__ . '/../view/templates/page/estimate.phtml',
            'yu/blog/rubric' => __DIR__ . '/../view/templates/blog/rubric.phtml',
            'yu/blog/post' => __DIR__ . '/../view/templates/blog/post.phtml',

            'yu/board' => __DIR__ . '/../view/templates/board/board.phtml',
            'yu/board/form' => __DIR__ . '/../view/templates/board/form.phtml',
            'yu/board/send' => __DIR__ . '/../view/templates/board/send.phtml',

            'yu/buy' => __DIR__ . '/../view/templates/buy/index.phtml',

            'yu/review' => __DIR__ . '/../view/templates/review/index.phtml',

            'yu/gallery/photogallery' => __DIR__ . '/../view/templates/gallery/photogallery.phtml',
            'yu/gallery/plan' => __DIR__ . '/../view/templates/gallery/plan.phtml',
            'yu/gallery/awards' => __DIR__ . '/../view/templates/gallery/awards.phtml',

            'agent/search' => __DIR__ . '/../view/templates/agent/search.phtml',
            'agent/page' => __DIR__ . '/../view/templates/agent/page.phtml',
            'realty/map/catalog' => __DIR__ . '/../view/templates/realty/map/map-catalog.phtml',
            'realty/map/view' => __DIR__ . '/../view/templates/realty/map/map-view.phtml',
            'realty/catalog' => __DIR__ . '/../view/templates/realty/catalog.phtml',
            'realty/view' => __DIR__ . '/../view/templates/realty/view.phtml',
            'realty/item' => __DIR__ . '/../view/templates/realty/item.phtml',
            'realty/hot' => __DIR__ . '/../view/templates/realty/hot.phtml',
            'realty/compare' => __DIR__ . '/../view/templates/realty/compare/compare.phtml',
            'realty/compare/ajax' => __DIR__ . '/../view/templates/realty/compare/ajax.phtml',
            'realty/price' => __DIR__ . '/../view/templates/realty/price.phtml',
            'realty/not-found' => __DIR__ . '/../view/templates/realty/not-found.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],

    'translator' => [
        'translation_file_patterns' => [
            [
                'type' => 'phparray',
                'base_dir' => __DIR__ . '/../i18n',
                'pattern' => '%s.php',
            ],
        ],
    ],
];
