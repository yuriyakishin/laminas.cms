<?php


namespace Yu\Realty\Controller\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class HotControllerFactory
{
    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $realtyManager = $container->get('realtyManager');
        return new $requestedName($realtyManager);
    }
}