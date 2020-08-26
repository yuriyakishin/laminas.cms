<?php

namespace Yu\Eav\Controller\Plugin\Factory;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Yu\Eav\Service\EavManager;

class EavManagerPluginFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var EavManager $eavManager */
        $eavManager = $container->get('eavManager');
        return new $requestedName($eavManager);
    }
}