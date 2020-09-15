<?php

declare(strict_types=1);

namespace Yu\Seo;

use Laminas\Mvc\MvcEvent;
use Laminas\Mvc\Controller\AbstractActionController;

class Module
{
    public function getConfig() : array
    {
        $config = array();
        $configFiles = array(
            __DIR__ . '/config/module.config.php',
            __DIR__ . '/config/form.config.php',
        );
        foreach($configFiles as $configFile) {
            $config = \Laminas\Stdlib\ArrayUtils::merge($config, include $configFile);
        }
        return $config;
    }

    public function onBootstrap(MvcEvent $event)
    {
        // Get event manager.
        $eventManager = $event->getApplication()->getEventManager();
        $sharedEventManager = $eventManager->getSharedManager();
        // Register the event listener method.
        $sharedEventManager->attach('*',
            MvcEvent::EVENT_RENDER, [$this, 'onRender'], 10000);
    }

    public function onRender(MvcEvent $e)
    {
        $metaModel = \Yu\Seo\Model\Meta::getInstance();
        foreach($e->getViewModel()->getChildren() as $view)
        {
            $vars = $view->getVariables();
            if(isset($vars['path'])) {
                $metaModel->setPath((string)$vars['path']);
            }
            if(isset($vars['entityId'])) {
                $metaModel->setEntityId($vars['entityId']);
            }
            if(isset($vars['entity_id'])) {
                $metaModel->setEntityId($vars['entity_id']);
            }
        }

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
