<?php

namespace Yu\Eav\Repository;

use Doctrine\ORM\EntityRepository;
use Yu\Eav\Entity\EavValueInterface;

abstract class AbstractEavValueRepository extends EntityRepository
{
    /**
     * @param int $attributeId
     * @param int $entityId
     * @param $value
     * @return mixed
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(int $attributeId, int $entityId, $value)
    {
        /** @var EavValueInterface $entity */
        $entity = $this->getEntity($attributeId,$entityId);
        $entity->setAttributeId($attributeId);
        $entity->setEntityId($entityId);
        $entity->setValue($value);
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();

        return $entity->getId();
    }

    /**
     * @param int $attributeId
     * @param int $entityId
     * @return EavValueInterface
     */
    public function getEntity(int $attributeId, int $entityId)
    {
        /** @var EavValueInterface $entity */
        $entity = $this->findOneBy(['attributeId' => $attributeId, 'entityId' => $entityId]);
        if($entity === null) {
            $entityName = $this->getEntityName();
            /** @var EavValueInterface $entity */
            $entity = new $entityName;
        }
        return $entity;
    }


    /**
     * @param int|null $entityId
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function removeByEntityId(int $entityId = null)
    {
        if($entityId!== null) {
            $entities = $this->findByEntityId($entityId);
            foreach ($entities as $entity) {
                $this->getEntityManager()->remove($entity);
                $this->getEntityManager()->flush();
            }
        }
    }
}