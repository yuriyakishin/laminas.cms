<?php

namespace Yu\Poll\Repository;

use Doctrine\ORM\EntityRepository;
use Yu\Poll\Entity\PollTheme;

class PollThemeRepository extends EntityRepository
{
    /**
     * @param PollTheme $entity
     * @return int
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(PollTheme $entity)
    {
        $currentDate = new \DateTime("now");
        $entity->setDate($currentDate);
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();

        return $entity->getId();
    }

    /**
     * @param PollTheme $entity
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove(PollTheme $entity)
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }
}