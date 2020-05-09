<?php

namespace Yu\Geo\Repository;

use Doctrine\ORM\EntityRepository;
use Yu\Geo\Entity\Marker;

class MarkerRepository extends EntityRepository
{
    /**
     * @param string $path
     * @param int $pathId
     * @return object|Marker|null
     */
    public function findMarker(string $path, int $pathId)
    {
        $entity = $this->getEntityManager()->getRepository(Marker::class)->findOneBy([
            'path' => $path,
            'pathId' => $pathId,
        ]);

        if(empty($entity)) {
            $entity = new Marker();
        }

        return $entity;
    }

    /**
     * @param Marker $entity
     * @return Marker
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Marker $entity)
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();

        return $entity;
    }

    /**
     * @param Marker $entity
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove(Marker $entity)
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }
}