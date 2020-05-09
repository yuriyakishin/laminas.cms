<?php

namespace Yu\Realty\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Yu\Realty\Entity\Realty;
use Yu\Realty\Entity\RealtyValueInt;

class RealtyRepository extends EntityRepository
{

    /**
     * @param Realty $entity
     * @return int
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Realty $entity)
    {
        $currentDate = new \DateTime("now");
        $entity->setCreatedAt($currentDate);
        $entity->setUpdatedAt($currentDate);
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();

        return $entity->getId();
    }

    /**
     * @param Realty $entity
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove(Realty $entity)
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }

}