<?php

namespace Yu\Poll\Repository;

use Doctrine\ORM\EntityRepository;
use Yu\Poll\Entity\PollOption;

class PollOptionRepository extends EntityRepository
{
    /**
     * @param PollOption $entity
     * @return int
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(PollOption $entity)
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();

        return $entity->getId();
    }

    /**
     * @param PollOption $entity
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove(PollOption $entity)
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }
}