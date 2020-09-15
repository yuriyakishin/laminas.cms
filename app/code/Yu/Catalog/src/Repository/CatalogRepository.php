<?php

namespace Yu\Catalog\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Yu\Catalog\Entity\Catalog;
use Yu\Eav\Entity\EavValueInt;
use Yu\Eav\Entity\EavValueText;

class CatalogRepository extends EntityRepository
{
    /**
     * @return \Doctrine\ORM\Query
     */
    public function getQuery()
    {
        $queryBuilder = $this->getQueryBuilder();
        $query = $queryBuilder->getQuery();
        return $query;
    }

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getQueryBuilder()
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();

        $queryBuilder
            ->addSelect('catalog.id as id')
            ->addSelect('catalog.name as name')
            ->addSelect('catalog.content as content')
            ->addSelect('catalog.active as active')
            ->addSelect('catalog.sort as sort')
            ->addSelect('category.value as category_id')
            ->addSelect('p.value as phone')
            ->addSelect('e.value as email')
            ->from(Catalog::class, 'catalog')
            ->leftJoin(EavValueInt::class, 'category', Join::WITH, 'catalog.id=category.entityId and category.attributeId=901')
            ->leftJoin(EavValueText::class, 'p', Join::WITH, 'catalog.id=p.entityId and p.attributeId=902')
            ->leftJoin(EavValueText::class, 'e', Join::WITH, 'catalog.id=e.entityId and e.attributeId=903');

        return $queryBuilder;
    }

    public function findCatalog(array $criteria = null, array $orderBy = null, $limit = null, $offset = null)
    {
        $queryBuilder = $this->getQueryBuilder();
        if ($criteria !== null) {
            $i = 1;
            foreach ($criteria as $key => $val) {
                $queryBuilder->andWhere($key . ' = ' . '?' . $i);
                $queryBuilder->setParameter($i, $val);
                $i++;
            }
        }

        if ($orderBy !== null) {
            foreach ($orderBy as $key => $value) {
                $queryBuilder->addOrderBy($key, $value);
            }
        }

        if ($limit !== null) {
            $queryBuilder->setMaxResults($limit);
        }

        $query = $queryBuilder->getQuery();

        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * @param Catalog $entity
     * @return int
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Catalog $entity)
    {
        $currentDate = new \DateTime("now");
        $entity->setCreatedAt($currentDate);
        $entity->setUpdatedAt($currentDate);
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();

        return $entity->getId();
    }
}