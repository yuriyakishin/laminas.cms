<?php

namespace Yu\RealtySaleLand\Controller\Admin\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Yu\Realty\Controller\Admin\RealtyController;
use Yu\RealtySaleLand\Repository\SaleLandRepository;
use Yu\RealtySaleLand\Repository\SearchCriteriaBuilder;

class SaleLandControllerFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $realtyManager = $container->get('realty.manager');
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $repository = new SaleLandRepository($entityManager);
        $realtyConfigManager = $container->get('realty.config.manager');
        $realtyConfigManager->setRealtyType('sale-land');

        return new RealtyController($realtyManager, $realtyConfigManager, $repository,new SearchCriteriaBuilder());
    }
}