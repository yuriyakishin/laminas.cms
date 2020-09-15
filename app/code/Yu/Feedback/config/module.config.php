<?php

declare(strict_types=1);

namespace Yu\Feedback;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\Router\RouteInvokableFactory;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [

    'router' => [
        'routes' => [
            'feedback' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/feedback',
                    'defaults' => [
                        'controller' => Controller\FeedbackController::class,
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],


    'controllers' => [
        'factories' => [
            Controller\FeedbackController::class => InvokableFactory::class,
        ],
    ],
];
