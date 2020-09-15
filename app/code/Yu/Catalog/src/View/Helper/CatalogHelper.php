<?php

namespace Yu\Catalog\View\Helper;

use Laminas\View\Helper\AbstractHelper;
use Yu\Catalog\Entity\Catalog;

class CatalogHelper extends AbstractHelper
{
    /**
     * @var $entityManager
     */
    private $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getCatalog(array $criterial = null, array $orderBy = null, int $limit = null)
    {
        /** @var \Yu\Catalog\Repository\CatalogRepository $repository */
        $repository = $this->entityManager->getRepository(Catalog::class);

        $result = $repository->findCatalog($criterial, $orderBy, $limit);

        return $result;
    }
}