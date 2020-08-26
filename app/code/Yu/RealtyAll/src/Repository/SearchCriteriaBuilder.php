<?php

namespace Yu\RealtyAll\Repository;

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

        if(!empty($params['code'])) {
            $queryBuilder->andWhere('r.code=:code')->setParameter('code',$params['code']);
        }


        return $queryBuilder;
    }

}