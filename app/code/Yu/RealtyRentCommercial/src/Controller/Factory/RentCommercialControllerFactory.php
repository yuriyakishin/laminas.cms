<?php

namespace Yu\RealtyRentCommercial\Controller\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Yu\Realty\Controller\RealtyController;
use Yu\RealtyRentCommercial\Repository\RentCommercialRepository;
use Yu\RealtyRentCommercial\Repository\SearchCriteriaBuilder;

class RentCommercialControllerFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $realtyManager = $container->get('realty.manager');
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $repository = new RentCommercialRepository($entityManager);
        $realtyConfigManager = $container->get('realty.config.manager');
        $realtyConfigManager->setRealtyType('rent-commercial');

        $searchCriteriaBuilder = new SearchCriteriaBuilder();

        return new RealtyController($realtyManager, $realtyConfigManager, $repository, $searchCriteriaBuilder);
    }
}