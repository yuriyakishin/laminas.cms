<?php

namespace Yu\Geo\Controller\Plugin;

use Laminas\Mvc\Controller\Plugin\AbstractPlugin;

class GeoManagerPlugin extends AbstractPlugin
{
    /**
     * @var \Yu\Geo\Service\GeoManager
     */
    private $geoManager;

    /**
     * GeoManagerPlugin constructor.
     * @param \Yu\Geo\Service\GeoManager $geoManager
     */
    public function __construct(
        \Yu\Geo\Service\GeoManager $geoManager
    )
    {
        $this->geoManager = $geoManager;
    }

    /**
     * @return \Yu\Geo\Service\GeoManager
     */
    public function __invoke()
    {
        return $this->geoManager;
    }
}