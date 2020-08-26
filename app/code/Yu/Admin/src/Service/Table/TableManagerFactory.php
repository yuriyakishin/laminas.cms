<?php

namespace Yu\Admin\Service\Table;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\ServiceManager\Exception\ServiceNotCreatedException;
use Laminas\ServiceManager\Exception\ServiceNotFoundException;

class TableManagerFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('Config');
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $renderer = $container->get(\Laminas\View\Renderer\PhpRenderer::class);
        return new $requestedName($config, $entityManager,$renderer);
    }
}