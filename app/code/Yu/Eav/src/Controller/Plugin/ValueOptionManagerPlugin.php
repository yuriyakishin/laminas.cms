<?php

namespace Yu\Eav\Controller\Plugin;

use Laminas\Mvc\Controller\Plugin\AbstractPlugin;
use Yu\Eav\Service\ValueOptionManager;

class ValueOptionManagerPlugin extends AbstractPlugin
{
    /**
     * @var ValueOptionManager
     */
    private $valueOptionManager;

    /**
     * ValueOptionManagerPlugin constructor.
     * @param ValueOptionManager $valueOptionManager
     */
    public function __construct(ValueOptionManager $valueOptionManager)
    {
        $this->valueOptionManager = $valueOptionManager;
    }

    /**
     * @return ValueOptionManager
     */
    public function __invoke()
    {
        return $this->getValueOptionManager();
    }

    /**
     * @return ValueOptionManager
     */
    public function getValueOptionManager()
    {
        return $this->valueOptionManager;
    }
}