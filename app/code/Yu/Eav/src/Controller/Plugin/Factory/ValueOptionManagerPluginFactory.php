<?php

namespace Yu\Eav\Controller\Plugin\Factory;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\ServiceManager\Exception\ServiceNotCreatedException;
use Laminas\ServiceManager\Exception\ServiceNotFoundException;

class ValueOptionManagerPluginFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $valueOptionManager = $container->get(\Yu\Eav\Service\ValueOptionManager::class);
        return new $requestedName($valueOptionManager);
    }
}