<?php

namespace Yu\Admin\Controller\Plugin\Factory;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\ServiceManager\Exception\ServiceNotCreatedException;
use Laminas\ServiceManager\Exception\ServiceNotFoundException;
use Yu\Admin\Service\User\AdminUserManager;
use Yu\Admin\Controller\Plugin\AuthAdminPlugin;

class AuthAdminPluginFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $authManager = $container->get('Yu\Admin\AuthManager');
        $adminUserManager = $container->get(AdminUserManager::class);
        return new AuthAdminPlugin($authManager, $adminUserManager);
    }

}