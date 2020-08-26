<?php

namespace Yu\Eav\Controller\Plugin;

use Laminas\Mvc\Controller\Plugin\AbstractPlugin;
use Yu\Eav\Service\EavManager;

class EavManagerPlugin extends AbstractPlugin
{
    /**
     * @var EavManager
     */
    private $eavManager;

    /**
     * EavManagerPlugin constructor.
     * @param EavManager $eavManager
     */
    public function __construct(
        EavManager $eavManager
    )
    {
        $this->eavManager = $eavManager;
    }

    /**
     * @return EavManager
     */
    public function __invoke()
    {
        return $this->eavManager;
    }

}