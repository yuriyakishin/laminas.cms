<?php

namespace Yu\Blog\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Yu\Blog\Entity\Post;

class PostRepository extends EntityRepository
{

    /**
     * @param Post $entity
     * @return int
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Post $entity)
    {
        $currentDate = new \DateTime("now");
        $entity->setCreatedAt($currentDate);
        $entity->setUpdatedAt($currentDate);
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();

        return $entity->getId();
    }

    /**
     * @param Post $entity
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove(Post $entity)
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }

    /**
     * @param int $ribricId
     * @return \Doctrine\ORM\Query
     */
    public function queryPostsByRubric(int $ribricId)
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $queryBuilder->select('p')
            ->from(Post::class, 'p')
            ->where('p.rubric_id = ?1')
            ->andWhere('p.active = ?2')
            ->orderBy('p.date', 'DESC')
            ->setParameter('1', $ribricId)
            ->setParameter('2', 1);
        return $queryBuilder->getQuery();
    }
}