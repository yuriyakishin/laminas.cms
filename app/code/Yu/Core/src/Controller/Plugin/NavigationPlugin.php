<?php

namespace Yu\Core\Controller\Plugin;

use Laminas\Mvc\Controller\Plugin\AbstractPlugin;
use Laminas\Navigation\Navigation;

class NavigationPlugin extends AbstractPlugin
{
    /**
     * @var Navigation
     */
    private $navigation;

    /**
     * NavigationPlugin constructor.
     * @param Navigation $navigation
     */
    public function __construct(Navigation $navigation)
    {
        $this->navigation = $navigation;
    }

    /**
     * @return Navigation
     */
    public function __invoke()
    {
        return $this->navigation;
    }
}