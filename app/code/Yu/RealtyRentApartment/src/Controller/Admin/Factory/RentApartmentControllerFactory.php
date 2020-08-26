<?php

namespace Yu\RealtyRentApartment\Controller\Admin\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Yu\Realty\Controller\Admin\RealtyController;
use Yu\RealtyRentApartment\Repository\RentApartmentRepository;

class RentApartmentControllerFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $realtyManager = $container->get('realty.manager');
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $repository = new RentApartmentRepository($entityManager);
        $realtyConfigManager = $container->get('realty.config.manager');
        $realtyConfigManager->setRealtyType('rent-apartment');

        return new RealtyController($realtyManager, $realtyConfigManager, $repository);
    }
}