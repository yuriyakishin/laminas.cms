<?php

namespace Yu\Core\Controller\Plugin;

use Laminas\Mvc\Controller\Plugin\AbstractPlugin;

class EntityManagerPlugin extends AbstractPlugin
{
    /**
     * @var object
     */
    private $entityManager;

    /**
     * EntityManagerPlugin constructor.
     * @param $entityManager
     */
    public function __construct(object $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return object
     */
    public function __invoke()
    {
        return $this->getManager();
    }

    /**
     * @return object
     */
    public function getManager()
    {
        return $this->entityManager;
    }
}