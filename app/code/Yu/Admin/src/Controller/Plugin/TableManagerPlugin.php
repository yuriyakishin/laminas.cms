<?php

namespace Yu\Admin\Controller\Plugin;

use Laminas\Mvc\Controller\Plugin\AbstractPlugin;

class TableManagerPlugin extends AbstractPlugin
{
    /**
     * @var object
     */
    private $tableManager;

    /**
     * TableManagerPlugin constructor.
     * @param object $tableManager
     */
    public function __construct(object $tableManager)
    {
        $this->tableManager = $tableManager;
    }

    /**
     * @return object
     */
    public function __invoke()
    {
        return $this->getTableManager();
    }

    /**
     * @return object
     */
    public function getTableManager()
    {
        return $this->tableManager;
    }
}