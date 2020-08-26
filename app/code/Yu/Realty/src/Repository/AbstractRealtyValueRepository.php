<?php


namespace Yu\Realty\Repository;

use Doctrine\ORM\EntityRepository;

abstract class AbstractRealtyValueRepository extends EntityRepository
{
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