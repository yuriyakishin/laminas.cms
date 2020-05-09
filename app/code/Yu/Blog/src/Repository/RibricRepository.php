<?php

namespace Yu\Blog\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Yu\Blog\Entity\Rubric;

class RibricRepository extends EntityRepository
{
    /**
     * @param int $id
     * @return object|null
     */
    public function findRubricById($id)
    {
        $entity = $this->getEntityManager()->getRepository(Rubric::class)->find($id);

        if(empty($entity)) {
            $entity = new Rubric();
        }

        return $entity;
    }

    /**
     * @param Rubric $entity
     * @return int
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Rubric $entity)
    {
        $currentDate = new \DateTime("now");
        $entity->setCreatedAt($currentDate);
        $entity->setUpdatedAt($currentDate);
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();

        return $entity->getId();
    }

    /**
     * @param Rubric $entity
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove(Rubric $entity)
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }
}