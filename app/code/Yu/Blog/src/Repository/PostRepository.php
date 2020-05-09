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
        if(empty($entity->getCreatedAt())) {
            $entity->setCreatedAt($currentDate);
        }
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
}