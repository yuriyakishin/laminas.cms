<?php

declare(strict_types=1);

namespace Yu\Site;

use Laminas\Mvc\MvcEvent;
use Laminas\ModuleManager\ModuleManager;
use Locale;
use Yu\Site\ValueObject\Lang;

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

        //

        if (php_sapi_name() == "cli") {
            return;
        }
        /** @var \Laminas\Uri\Http $uri */
        $uri = $_SERVER['REQUEST_URI'];
        $pathArray = explode('/', $uri);
        if(!empty($pathArray) && count($pathArray) > 1 && $pathArray[1] !== 'admin') {
            foreach (Lang::getLangs() as $lang) {
                if($lang['code'] === $pathArray[1]) {
                    Lang::setCurrentLang($lang);
                    break;
                }
            }
        }
        $locale = Lang::getCurrentLang()['i18n'];
        Locale::setDefault($locale);
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
                foreach (Lang::getLangs() as $lang) {
                    if($lang['code'] === $pathArray[1]) {
                        unset( $pathArray[1]);
                        $uriNew = implode('/',$pathArray);
                        if(empty($uriNew)) {
                            $uriNew = '/';
                        }
                        $uri->setPath($uriNew);
                        $request->setUri($uri);
                        Locale::setDefault($lang['i18n']);
                        break;
                    }
                }
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
