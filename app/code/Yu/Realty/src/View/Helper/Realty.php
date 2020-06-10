<?php

namespace Yu\Realty\View\Helper;

use Laminas\View\Helper\AbstractHelper;
use Yu\Realty\Entity\Realty as RealtyEntity;

class Realty extends AbstractHelper
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * @var \Yu\Realty\Repository\RealtyRepository
     */
    private $realtyRepository;

    public function __construct(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->realtyRepository = $entityManager->getRepository(RealtyEntity::class);
    }

    /**
     * @param string|null $type
     * @return string
     */
    public function getCount(string $type = null)
    {
        $countSelect = $this->realtyRepository->createQueryBuilder('r')
            ->select('count(r.id)')
            ->where('r.active = 1');

        if($type !== null) {
            $countSelect->where("r.type = '".$type."'");
        }

        $count = $countSelect->getQuery()->getSingleScalarResult();

        return (string) $count;
    }


}