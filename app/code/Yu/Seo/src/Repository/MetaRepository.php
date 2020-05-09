<?php

namespace Yu\Seo\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Yu\Seo\Entity\Meta;

class MetaRepository extends EntityRepository
{
    /**
     * @param $path
     * @param $entityId
     * @return object|Meta|null
     */
    public function findMeta($path, $entityId)
    {
        $entity = $this->getEntityManager()->getRepository(Meta::class)->findOneBy([
            'path' => $path,
            'entityId' => $entityId]);

        if(empty($entity)) {
            $entity = new Meta();
        }

        return $entity;
    }

    /**
     * @param Meta $entity
     * @return int
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Meta $entity)
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();

        return $entity->getId();
    }

    /**
     * @param Meta $meta
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove(Meta $meta)
    {
        $this->getEntityManager()->remove($meta);
        $this->getEntityManager()->flush();
    }
}