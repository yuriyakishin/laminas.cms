<?php

namespace Yu\Price\Controller\Plugin;

use Laminas\Mvc\Controller\Plugin\AbstractPlugin;

class PriceManagerPlugin extends AbstractPlugin
{
    /**
     * @var \Yu\Price\Service\PriceManager
     */
    private $priceManager;

    /**
     * PriceManagerPlugin constructor.
     * @param \Yu\Price\Service\PriceManager $priceManager
     */
    public function __construct(
        \Yu\Price\Service\PriceManager $priceManager
    )
    {
        $this->priceManager = $priceManager;
    }

    /**
     * @return \Yu\Price\Service\PriceManager
     */
    public function __invoke()
    {
        return $this->priceManager;
    }
}