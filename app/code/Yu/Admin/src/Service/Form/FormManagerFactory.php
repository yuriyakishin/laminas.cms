<?php

namespace Yu\Admin\Service\Form;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\ServiceManager\Exception\ServiceNotCreatedException;
use Laminas\ServiceManager\Exception\ServiceNotFoundException;


class FormManagerFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $formModel = FormModel::getInstance();
        $config = $container->get('Config');
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        return new FormManager($formModel, $config, $entityManager);
    }
}