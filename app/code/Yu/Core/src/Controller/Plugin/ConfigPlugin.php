<?php

namespace Yu\Core\Controller\Plugin;

use Laminas\Mvc\Controller\Plugin\AbstractPlugin;

class ConfigPlugin extends AbstractPlugin
{
    private $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function get()
    {
        return $this->config;
    }
}