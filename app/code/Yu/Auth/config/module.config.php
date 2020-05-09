<?php

declare(strict_types=1);

namespace Yu\Auth;

use DoctrineModule\Service\Authentication\AdapterFactory;
use Laminas\Router\Http\Literal;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [

    'service_manager' => [
        'factories' => [
            'Yu\Auth\Adapter' => \DoctrineModule\Service\Authentication\AdapterFactory::class,
            \Laminas\Authentication\AuthenticationService::class => AuthServiceFactory::class,
        ],
    ],
];
