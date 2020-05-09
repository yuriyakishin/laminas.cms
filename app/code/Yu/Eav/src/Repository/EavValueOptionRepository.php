<?php

namespace Yu\Eav\Repository;

use Doctrine\ORM\EntityRepository;
use Yu\Eav\Entity\EavValueOption;

class EavValueOptionRepository extends EntityRepository
{

    /**
     * @param EavValueOption $entity
     * @return int
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(EavValueOption $entity)
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();

        return $entity->getId();
    }

    /**
     * @param EavValueOption $entity
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove(EavValueOption $entity)
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }

}