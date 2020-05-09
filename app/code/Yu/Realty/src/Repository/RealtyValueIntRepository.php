<?php

namespace Yu\Realty\Repository;

use Doctrine\ORM\EntityRepository;
use Yu\Realty\Entity\Realty;
use Yu\Realty\Entity\RealtyValueInt as RealtyValue;

class RealtyValueIntRepository extends EntityRepository implements RealtyValueRepositoryInterface
{
    /**
     * @param RealtyValue $entity
     * @return int
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(RealtyValue $entity)
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();

        return $entity->getId();
    }
}