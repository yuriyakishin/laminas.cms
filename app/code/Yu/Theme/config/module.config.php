<?php

declare(strict_types=1);

namespace Yu\Theme;

use Laminas\Router\Http\Literal;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
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
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',

            'yu/index' => __DIR__ . '/../view/templates/index/index.phtml',
            'yu/page' => __DIR__ . '/../view/templates/page/page.phtml',
            'yu/blog/rubric' => __DIR__ . '/../view/templates/blog/rubric.phtml',
            'yu/blog/post' => __DIR__ . '/../view/templates/blog/post.phtml',

            'realty/map' => __DIR__ . '/../view/templates/realty/map.phtml',
            'realty/catalog' => __DIR__ . '/../view/templates/realty/catalog.phtml',
            'realty/view' => __DIR__ . '/../view/templates/realty/view.phtml',
            'realty/item' => __DIR__ . '/../view/templates/realty/item.phtml',
            'realty/price' => __DIR__ . '/../view/templates/realty/price.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],

    'translator' => [
        'locale' => 'ru_RU',
        'translation_file_patterns' => [
            [
                'type'     => 'phparray',
                'base_dir' => __DIR__ . '/../i18n',
                'pattern'  => '%s.php',
            ],
        ],
    ],
];
