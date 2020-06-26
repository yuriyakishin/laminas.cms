<?php

namespace Yu\RealtySaleFlat\Controller\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Yu\Realty\Controller\RealtyController;
use Yu\RealtySaleFlat\Repository\SaleFlatRepository;

class SaleFlatControllerFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $realtyManager = $container->get('realty.manager');
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $repository = new SaleFlatRepository($entityManager);
        $realtyConfigManager = $container->get('realty.config.manager');
        $realtyConfigManager->setRealtyType('sale-flat');

        return new RealtyController($realtyManager, $realtyConfigManager, $repository);
    }
}