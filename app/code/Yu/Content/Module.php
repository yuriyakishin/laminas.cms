<?php

declare(strict_types=1);

namespace Yu\Content;

use Laminas\EventManager\EventInterface;

class Module
{
    public function getConfig(): array
    {
        $config = array();
        $configFiles = array(
            __DIR__ . '/config/module.config.php',
            __DIR__ . '/config/form.config.php',
            __DIR__ . '/config/navigation.config.php',
            __DIR__ . '/config/table.config.php',
        );
        foreach ($configFiles as $configFile) {
            $config = \Laminas\Stdlib\ArrayUtils::merge($config, include $configFile);
        }
        return $config;
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Laminas\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/',
                ),
            ),
        );
    }

    public function onBootstrap(EventInterface $e)
    {
        // Set Page route
        $routeOptions = [
            'options' => [
                'defaults' => [
                    'controller' => Controller\ContentController::class,
                    'action' => 'content',
                ]]];
        $route = new \Yu\Content\Route\Page($routeOptions);
        $em = $e->getApplication()->getServiceManager()->get('doctrine.entitymanager.orm_default');
        $route->setEntityManager($em);
        $e->getRouter()->addRoute('page', $route, 100);
    }
}
