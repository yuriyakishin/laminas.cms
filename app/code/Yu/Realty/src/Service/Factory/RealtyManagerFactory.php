<?php

namespace Yu\Realty\Service\Factory;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Laminas\ServiceManager\Factory\FactoryInterface;

class RealtyManagerFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $realtyConfigManager = $container->get('realty.config.manager');
        return new $requestedName($entityManager, $realtyConfigManager);
    }
}