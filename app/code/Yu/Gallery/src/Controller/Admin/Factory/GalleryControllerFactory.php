<?php

namespace Yu\Gallery\Controller\Admin\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Yu\Admin\Service\Table\TableManager;

class GalleryControllerFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $tableManager = $container->get(TableManager::class);
        $formManager = $container->get(\Yu\Admin\Service\Form\FormManager::class);
        return new $requestedName($tableManager, $formManager);
    }
}