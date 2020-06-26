<?php

declare(strict_types=1);

namespace Yu\Site;

use Laminas\Mvc\MvcEvent;
use Laminas\ModuleManager\ModuleManager;

class Module
{

    public function init(ModuleManager $manager)
    {
        // Получаем менеджер событий.
        $eventManager = $manager->getEventManager();
        /** @var \Laminas\EventManager\SharedEventManager $sharedEventManager */
        $sharedEventManager = $eventManager->getSharedManager();
        // Регистрируем метод-обработчик.
        $sharedEventManager->attach("*", MvcEvent::EVENT_ROUTE,
            [$this, 'onRouteLocale'], 100);
    }

    public function onRouteLocale(MvcEvent $event)
    {
        if (php_sapi_name() == "cli") {
            return;
        }

        /** @var \Laminas\Http\PhpEnvironment\Request $request */
        $request = $event->getRequest();

        if($request instanceof \Laminas\Http\Request) {
            /** @var \Laminas\Uri\Http $uri */
            $uri = $event->getRequest()->getUri();
            $path = $uri->getPath();
            $pathArray = explode('/', $path);
            if(!empty($pathArray) && count($pathArray) > 1 && $pathArray[1] !== 'admin') {
                //$uri->setPath('/');
                //$request->setUri($uri);
            }
        }
    }

    public function getConfig(): array
    {
        return include __DIR__ . '/config/module.config.php';
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
}
