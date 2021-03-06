<?php

namespace Yu\RealtyRentFlat\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Yu\Realty\Repository\RealtyRepositoryInterface;
use Yu\Realty\Entity\Realty;
use Yu\Realty\Entity\RealtyValueInt;
use Yu\Realty\Entity\RealtyValueText;
use Yu\Price\Entity\Price;
use Yu\Price\Entity\Currency;
use Yu\Geo\Entity\Marker;

class RentFlatRepository implements RealtyRepositoryInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(
        EntityManager $entityManager
    )
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param array|null $criteria
     * @return mixed
     */
    public function findRealty(array $criteria = null)
    {
        $queryBuilder = $this->getQueryBuilder();

        if(!empty($criteria)) {
            foreach ($criteria as $c) {
                $queryBuilder->andWhere($c['where']);
                $queryBuilder->setParameter($c['param']['key'], $c['param']['value']);
            }
        }

        $realty = $queryBuilder->getQuery()->getResult();
        return $realty;
    }

    public function getQueryBuilder()
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();

        $queryBuilder
            ->addSelect('r.id as id')
            ->addSelect('r.active as active')
            ->addSelect('r.code as code')
            ->addSelect('r.type as type')
            ->addSelect('r.agentId as agent_id')
            ->addSelect('r.main as main')
            ->addSelect('m.address as address')
            ->addSelect('m.lat as lat')
            ->addSelect('m.lng as lng')
            ->addSelect('i1.value as rooms')
            ->addSelect('i1.value as label_1')
            ->addSelect('i2.value as class')
            ->addSelect('d.value as district')
            ->addSelect('p.value as price')
            ->addSelect('p.currencyId as currency')
            ->addSelect('c.unit as currency_unit')
            ->from(Realty::class, 'r')
            ->leftJoin(Marker::class, 'm', Join::WITH, 'r.id=m.pathId and m.path=\'realty\'')
            ->leftJoin(RealtyValueInt::class, 'd', Join::WITH, 'r.id=d.entityId and d.attributeId=100')
            ->leftJoin(RealtyValueInt::class, 'i1', Join::WITH, 'r.id=i1.entityId and i1.attributeId=101')
            ->leftJoin(RealtyValueInt::class, 'i2', Join::WITH, 'r.id=i2.entityId and i2.attributeId=501')
            ->leftJoin(Price::class, 'p', Join::WITH, 'r.id=p.pathId')
            ->leftJoin(Currency::class, 'c', Join::WITH, 'c.id=p.currencyId')
            ->where('r.type=\'rent-flat\'');

        return $queryBuilder;
    }
}