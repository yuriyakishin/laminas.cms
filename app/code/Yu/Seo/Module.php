<?php

declare(strict_types=1);

namespace Yu\Seo;

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
