<?php

declare(strict_types=1);

namespace Yu\Admin;

use Laminas\Router\Http\Literal;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'admin' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/admin',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'login' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/login',
                            'defaults' => [
                                'controller' => Controller\LoginController::class,
                                'action' => 'index',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'enter' => [
                                'type' => Literal::class,
                                'options' => [
                                    'route' => '/enter',
                                    'defaults' => [
                                        'controller' => Controller\LoginController::class,
                                        'action' => 'enter',
                                    ],
                                ],
                            ],
                            'exit' => [
                                'type' => Literal::class,
                                'options' => [
                                    'route' => '/exit',
                                    'defaults' => [
                                        'controller' => Controller\LoginController::class,
                                        'action' => 'exit',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],

    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
            Controller\LoginController::class => InvokableFactory::class,
        ],
    ],

    'controller_plugins' => [
        'factories' => [
            \Yu\Admin\Controller\Plugin\AuthAdminPlugin::class => \Yu\Admin\Controller\Plugin\Factory\AuthAdminPluginFactory::class,
            \Yu\Admin\Controller\Plugin\TableManagerPlugin::class => \Yu\Admin\Controller\Plugin\Factory\TableManagerPluginFactory::class,
            \Yu\Admin\Controller\Plugin\FormManagerPlugin::class => \Yu\Admin\Controller\Plugin\Factory\FormManagerPluginFactory::class,
        ],
        'aliases' => [
            'authAdmin' => \Yu\Admin\Controller\Plugin\AuthAdminPlugin::class,
            'tableManager' => \Yu\Admin\Controller\Plugin\TableManagerPlugin::class,
            'formManager' => \Yu\Admin\Controller\Plugin\FormManagerPlugin::class,
        ],
    ],

    'service_manager' => [
        'factories' => [
            'Yu\Admin\AuthManager' => \Yu\Admin\Service\User\AuthManagerFactory::class,
            \Yu\Admin\Service\User\AdminUserManager::class => \Yu\Admin\Service\User\AdminUserManagerFactory::class,
            \Yu\Admin\Service\Form\FormManager::class => \Yu\Admin\Service\Form\FormManagerFactory::class,
            \Yu\Admin\Service\Table\TableManager::class => \Yu\Admin\Service\Table\TableManagerFactory::class,
        ],
        'aliases' => [
            'admin.form.manager' => \Yu\Admin\Service\Form\FormManager::class,
            'admin.table.manager' => \Yu\Admin\Service\Table\TableManager::class,
        ]
    ],

    'view_helpers' => [
        'factories' => [
            \Yu\Admin\View\Helper\TableHelper::class => \Yu\Admin\View\Helper\Factory\TableHelperFactory::class,
            \Yu\Admin\View\Helper\FormWiziwig::class => InvokableFactory::class,
        ],
        'aliases' => [
            'table' => \Yu\Admin\View\Helper\TableHelper::class,
            'wiziwig' => \Yu\Admin\View\Helper\FormWiziwig::class,
        ]
    ],

    'view_manager' => [
        'template_map' => [
            'admin/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'admin/layout/login' => __DIR__ . '/../view/layout/login.phtml',
            'admin/block/sidebar' => __DIR__ . '/../view/layout/block/sidebar.phtml',
            'admin/block/breadcrumbs' => __DIR__ . '/../view/layout/block/breadcrumbs.phtml',
            'admin/block/messenger' => __DIR__ . '/../view/layout/block/messenger.phtml',

            'admin/form' => __DIR__ . '/../view/templates/form/form.phtml',
            'admin/form/fieldset' => __DIR__ . '/../view/templates/form/fieldset.phtml',
            'admin/form/element' => __DIR__ . '/../view/templates/form/element.phtml',
            'admin/form/element/wiziwig' => __DIR__ . '/../view/templates/form/element/wiziwig.phtml',
            'admin/table' => __DIR__ . '/../view/templates/table/table.phtml',

            'admin/index' => __DIR__ . '/../view/templates/index/index.phtml',
            'admin/login/index' => __DIR__ . '/../view/templates/login/index.phtml',
            'registration/index' => __DIR__ . '/../view/admin/scripts/registration/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view/admin/scripts',
        ],
    ],

    'doctrine' => [
        'authentication' => [
            'orm_default' => [
                'object_manager' => 'Doctrine\ORM\EntityManager',
                'identity_class' => \Yu\User\Entity\User::class,
                'identity_property' => 'email',
                'credential_property' => 'password',
                'credential_callable' => '\Yu\Admin\Service\User\AuthManager::verifyCredential',
            ],
        ],
    ],
];
