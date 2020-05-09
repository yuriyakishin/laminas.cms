<?php

namespace Yu\Admin\Controller\Plugin;

use Laminas\Mvc\Controller\Plugin\AbstractPlugin;

class FormManagerPlugin extends AbstractPlugin
{
    /**
     * @var object
     */
    private $formManager;

    /**
     * FormManagerPlugin constructor.
     * @param object $formManager
     */
    public function __construct(object $formManager)
    {
        $this->formManager = $formManager;
    }

    /**
     * @return object
     */
    public function __invoke()
    {
        return $this->getFormManager();
    }

    /**
     * @return object
     */
    public function getFormManager()
    {
        return $this->formManager;
    }
}