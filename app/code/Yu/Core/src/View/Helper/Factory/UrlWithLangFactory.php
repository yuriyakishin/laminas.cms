<?php

namespace Yu\Core\View\Helper\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\Router\RouteMatch;
use Yu\Core\View\Helper\UrlWithLang;

class UrlWithLangFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $helper = new UrlWithLang();
        return $helper;
    }
}