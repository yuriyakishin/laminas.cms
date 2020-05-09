<?php

namespace Yu\Blog\Controller\Admin\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class PostControllerFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $tableManager = $container->get('admin.table.manager');
        $formManager = $container->get('admin.form.manager');
        return new $requestedName($tableManager, $formManager);
    }
}