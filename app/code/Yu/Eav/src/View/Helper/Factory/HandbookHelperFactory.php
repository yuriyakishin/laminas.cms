<?php

namespace Yu\Eav\View\Helper\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class HandbookHelperFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $valueOptionManager = $container->get('valueOptionManager');
        return new $requestedName($entityManager,$valueOptionManager);
    }
}