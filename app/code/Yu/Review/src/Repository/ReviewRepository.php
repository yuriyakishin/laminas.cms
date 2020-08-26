<?php

namespace Yu\Review\Repository;

use Doctrine\ORM\EntityRepository;
use Yu\Review\Entity\Review;

class ReviewRepository extends EntityRepository
{
    /**
     * @return \Doctrine\ORM\Query
     */
    public function getQuery()
    {
        $queryBuilder = $this->getQueryBuilder();
        $query = $queryBuilder->getQuery();
        return $query;
    }

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getQueryBuilder()
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();

        $queryBuilder
            ->addSelect('review')
            ->from(Review::class, 'review')
            ->where('review.active=1')
            ->addOrderBy('review.sort','DESC');

        return $queryBuilder;
    }

    /**
     * @param Review $entity
     * @return int
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Review $entity)
    {
        $currentDate = new \DateTime("now");
        $entity->setDate($currentDate);
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();

        return $entity->getId();
    }

    /**
     * @param Review $entity
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove(Review $entity)
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }
}