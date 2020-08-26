<?php

namespace Yu\RealtyRentHouse\Controller\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Yu\Realty\Controller\RealtyController;
use Yu\RealtyRentHouse\Repository\RentHouseRepository;
use Yu\RealtyRentHouse\Repository\SearchCriteriaBuilder;

class RentHouseControllerFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $realtyManager = $container->get('realty.manager');
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $repository = new RentHouseRepository($entityManager);
        $realtyConfigManager = $container->get('realty.config.manager');
        $realtyConfigManager->setRealtyType('rent-house');

        $searchCriteriaBuilder = new SearchCriteriaBuilder();

        return new RealtyController($realtyManager, $realtyConfigManager, $repository, $searchCriteriaBuilder);
    }
}