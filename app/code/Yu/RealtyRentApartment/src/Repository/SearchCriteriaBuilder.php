<?php

namespace Yu\RealtyRentApartment\Repository;

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

        if(!empty($params['room'])) {
            $room = [];
            foreach ($params['room'] as $r)
            {
                if(!empty($r)) {
                    if($r == 5) {
                        $r = [5,6,7,8,9,10,11,12];
                        $room = array_merge($room, $r);
                    } else {
                        $room[] = $r;
                    }
                }
            }
            if(!empty($room)) {
                $queryBuilder->andWhere($queryBuilder->expr()->in('i1.value', $room));
            }
        }

        if(!empty($params['price'])) {
            $queryBuilder->andWhere('p.value<=:price')->setParameter('price',$params['price']);
        }

        return $queryBuilder;
    }

}