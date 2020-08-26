<?php

namespace Yu\Realty\Repository;

use Doctrine\ORM\EntityRepository;
use Yu\Realty\Entity\Realty;
use Yu\Realty\Repository\AbstractRealtyValueRepository;
use Yu\Realty\Entity\RealtyValueText as RealtyValue;

class RealtyValueTextRepository extends AbstractRealtyValueRepository  implements RealtyValueRepositoryInterface
{
    public function save(RealtyValue $entity)
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();

        return $entity->getId();
    }
}