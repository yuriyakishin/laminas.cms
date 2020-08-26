<?php

namespace Yu\RealtyRentFlat\Controller\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Yu\Realty\Controller\RealtyController;
use Yu\RealtyRentFlat\Repository\RentFlatRepository;
use Yu\RealtyRentFlat\Repository\SearchCriteriaBuilder;

class RentFlatControllerFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $realtyManager = $container->get('realty.manager');
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $repository = new RentFlatRepository($entityManager);
        $realtyConfigManager = $container->get('realty.config.manager');
        $realtyConfigManager->setRealtyType('rent-flat');

        $searchCriteriaBuilder = new SearchCriteriaBuilder();

        return new RealtyController($realtyManager, $realtyConfigManager, $repository, $searchCriteriaBuilder);
    }
}