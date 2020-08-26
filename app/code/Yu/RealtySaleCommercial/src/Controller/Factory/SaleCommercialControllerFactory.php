<?php

namespace Yu\RealtySaleCommercial\Controller\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Yu\Realty\Controller\RealtyController;
use Yu\RealtySaleCommercial\Repository\SaleCommercialRepository;
use Yu\RealtySaleCommercial\Repository\SearchCriteriaBuilder;

class SaleCommercialControllerFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $realtyManager = $container->get('realty.manager');
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $repository = new SaleCommercialRepository($entityManager);
        $realtyConfigManager = $container->get('realty.config.manager');
        $realtyConfigManager->setRealtyType('sale-commercial');

        $searchCriteriaBuilder = new SearchCriteriaBuilder();

        return new RealtyController($realtyManager, $realtyConfigManager, $repository, $searchCriteriaBuilder);
    }
}