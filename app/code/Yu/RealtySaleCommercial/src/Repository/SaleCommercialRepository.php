<?php

namespace Yu\RealtySaleCommercial\Repository;

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
use Yu\Eav\Entity\EavValueOption;

class SaleCommercialRepository implements RealtyRepositoryInterface
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

    public function findRealty(array $criteria = null)
    {
        $queryBuilder = $this->getQueryBuilder();

        $realty = $queryBuilder->getQuery()->getResult();
        //echo $queryBuilder->getQuery()->getSQL(); die;
        //var_dump($realty);die;
        return $realty;
    }

    /**
     * @inheritDoc
     */
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
            ->addSelect('i1.value as commercial')
            ->addSelect('com.value as commercial_name')
            ->addSelect('com.value as label_1')
            ->addSelect('d.value as district')
            ->addSelect('p.value as price')
            ->addSelect('p.currencyId as currency')
            ->addSelect('c.unit as currency_unit')
            ->from(Realty::class, 'r')
            ->where('r.type=\'sale-commercial\'')
            ->leftJoin(Marker::class, 'm', Join::WITH, 'r.id=m.pathId and m.path=\'realty\'')
            ->leftJoin(RealtyValueInt::class, 'd', Join::WITH, 'r.id=d.entityId and d.attributeId=100')
            ->leftJoin(RealtyValueInt::class, 'i1', Join::WITH, 'r.id=i1.entityId and i1.attributeId=301')
            ->leftJoin(EavValueOption::class,'com',Join::WITH,'com.id=i1.value')
            ->leftJoin(Price::class, 'p', Join::WITH, 'r.id=p.pathId')
            ->leftJoin(Currency::class, 'c', Join::WITH, 'c.id=p.currencyId');

        return $queryBuilder;
    }
}