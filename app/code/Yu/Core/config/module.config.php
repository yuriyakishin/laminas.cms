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
        ],
        'aliases' => [
            'entityManager' => \Yu\Core\Controller\Plugin\EntityManagerPlugin::class,
            'getEntityManager' => \Yu\Core\Controller\Plugin\EntityManagerPlugin::class,
        ],
    ],

    'form_elements' => [
        'factories' => [
            'YuSelect' => \Yu\Core\Form\Element\Factory\ElementFactory::class,
        ],
    ],
];
