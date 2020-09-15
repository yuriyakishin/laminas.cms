<?php

namespace Yu\Poll\Repository;

use Doctrine\ORM\EntityRepository;
use Yu\Poll\Entity\PollResult;

class PollResultRepository extends EntityRepository
{
    /**
     * @param PollResult $entity
     * @return int
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(PollResult $entity)
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();

        return $entity->getId();
    }

    /**
     * @param PollResult $entity
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove(PollResult $entity)
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }
}