<?php

namespace Yu\RealtySaleLand\Repository;

use Doctrine\ORM\QueryBuilder;
use Yu\Realty\Api\SearchCriteriaBuilderInterface;


class SearchCriteriaBuilder implements SearchCriteriaBuilderInterface
{
    /**
     * @inheritDoc
     */
    public function build(QueryBuilder $queryBuilder, array $params)
    {
        if(!empty($params['id'])) {
            $queryBuilder->andWhere('r.id=:id')->setParameter('id',$params['id']);
        }

        if(!empty($params['district'])) {
            $queryBuilder->andWhere('d.value=:district')->setParameter('district',$params['district']);
        }

        if(!empty($params['price'])) {
            $queryBuilder->andWhere('p.value<=:price')->setParameter('price',$params['price']);
        }

        return $queryBuilder;
    }

}