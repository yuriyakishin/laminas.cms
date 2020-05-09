<?php

namespace Yu\Price\Controller\Plugin\Factory;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Laminas\ServiceManager\Factory\FactoryInterface;

class PriceManagerPluginFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $priceManager = $container->get('priceManager');
        return new $requestedName($priceManager);
    }
}