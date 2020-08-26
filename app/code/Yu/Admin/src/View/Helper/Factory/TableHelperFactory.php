<?php

namespace Yu\Admin\View\Helper\Factory;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\ServiceManager\Exception\ServiceNotCreatedException;
use Laminas\ServiceManager\Exception\ServiceNotFoundException;

class TableHelperFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('Config');
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $tableManager = $container->get('admin.table.manager');
        return new $requestedName($config, $entityManager, $tableManager);
    }
}