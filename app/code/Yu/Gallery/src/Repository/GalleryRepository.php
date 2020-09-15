<?php

namespace Yu\Gallery\Repository;

use Doctrine\ORM\EntityRepository;
use Yu\Gallery\Entity\Gallery;

class GalleryRepository extends EntityRepository
{
    public function save(Gallery $entity)
    {
        $currentDate = new \DateTime("now");
        $entity->setCreatedAt($currentDate);
        $entity->setUpdatedAt($currentDate);
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();

        return $entity->getId();
    }

    public function remove(Gallery $entity)
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }
}