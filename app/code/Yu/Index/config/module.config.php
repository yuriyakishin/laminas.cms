<?php

declare(strict_types=1);

namespace Yu\Index;

use Laminas\Router\Http\TreeRouteStack;
use Laminas\Router\Http\Literal;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'router_class' => TreeRouteStack::class,
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'template_map' => [
            'yu/index' => __DIR__ . '/../view/templates/index/index.phtml',
        ],
    ],
];
