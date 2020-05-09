<?php

namespace Yu\Media\Controller\Plugin;

use Laminas\Mvc\Controller\Plugin\AbstractPlugin;

class ImageManagerPlugin extends AbstractPlugin
{
    private $imageManager;

    public function __construct($imageManager)
    {
        $this->imageManager = $imageManager;
    }

    public function __invoke()
    {
        return $this->imageManager;
    }

}