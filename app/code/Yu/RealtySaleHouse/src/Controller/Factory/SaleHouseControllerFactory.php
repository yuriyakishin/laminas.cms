<?php

namespace Yu\RealtySaleHouse\Controller\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Yu\Realty\Controller\RealtyController;
use Yu\RealtySaleHouse\Repository\SaleHouseRepository;
use Yu\RealtySaleHouse\Repository\SearchCriteriaBuilder;

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

        $searchCriteriaBuilder = new SearchCriteriaBuilder();

        return new RealtyController($realtyManager, $realtyConfigManager, $repository, $searchCriteriaBuilder);
    }
}