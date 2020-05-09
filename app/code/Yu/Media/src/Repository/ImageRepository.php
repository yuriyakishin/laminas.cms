<?php

namespace Yu\Media\Repository;

use Doctrine\ORM\EntityRepository;
use Yu\Media\Entity\Image;

class ImageRepository extends EntityRepository
{
    /**
     * @param Image $entity
     * @return int
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Image $entity)
    {
        $currentDate = new \DateTime("now");
        $entity->setCreatedAt($currentDate);
        $entity->setUpdatedAt($currentDate);
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();

        return $entity->getId();
    }

    /**
     * @param Image $entity
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove(Image $entity)
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }

    /**
     * @param array $dataFromRequest
     * @param array $options
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function saveGallery($dataFromRequest, $options)
    {
        foreach ($dataFromRequest as $id => $data)
        {
            /**
             * @var \Yu\Media\Entity\Image $entity
             */
            $entity = $this->getEntityManager()->getRepository(Image::class)->find($id);
            $entity->setComment($data['comment']);
            $entity->setSort($data['sort']);
            $entity->setPath($options['path']);
            $entity->setPathId($options['path_id']);
            $entity->setTemp(0);
            $this->getEntityManager()->persist($entity);
            $this->getEntityManager()->flush();
        }
    }
}