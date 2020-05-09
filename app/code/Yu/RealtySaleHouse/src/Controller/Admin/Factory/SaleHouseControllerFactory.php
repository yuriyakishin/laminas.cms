<?php

namespace Yu\RealtySaleHouse\Controller\Admin\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Yu\Realty\Controller\Admin\RealtyController;
use Yu\RealtySaleHouse\Repository\SaleHouseRepository;

class SaleHouseControllerFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $realtyManager = $container->get('realty.manager');
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $repository = new SaleHouseRepository($entityManager);
        $realtyConfigManager = $container->get('realty.config.manager');
        $realtyConfigManager->setRealtyType('sale-house');

        return new RealtyController($realtyManager, $realtyConfigManager, $repository);
    }
}