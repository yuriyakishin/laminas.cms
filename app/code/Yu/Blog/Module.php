<?php

declare(strict_types=1);

namespace Yu\Blog;

use Laminas\EventManager\EventInterface;

class Module
{
    public function getConfig() : array
    {
        $config = array();
        $configFiles = array(
            __DIR__ . '/config/module.config.php',
            __DIR__ . '/config/navigation.config.php',
            __DIR__ . '/config/table.config.php',
            __DIR__ . '/config/form.config.php',
        );
        foreach($configFiles as $configFile) {
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
                    'controller' => Controller\BlogController::class,
                    'action' => 'content',
                ]]];
        $route = new Route\BlogRoute($routeOptions);
        $em = $e->getApplication()->getServiceManager()->get('doctrine.entitymanager.orm_default');
        $route->setEntityManager($em);
        $e->getRouter()->addRoute('blog', $route, 200);
    }

    public function getRouteConfig()
    {

    }
}
