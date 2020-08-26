<?php

namespace Yu\Price\Repository;

use Doctrine\ORM\EntityRepository;
use Yu\Price\Entity\Price;

class PriceRepository extends EntityRepository
{

    public function removeBy(array $criterial = null)
    {
        if ($criterial !== null) {
            $entities = $this->findBy($criterial);
            foreach ($entities as $entity) {
                $this->getEntityManager()->remove($entity);
                $this->getEntityManager()->flush();
            }
        }
    }
}