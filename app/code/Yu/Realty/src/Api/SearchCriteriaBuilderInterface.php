<?php

namespace Yu\Realty\Api;

use Doctrine\ORM\QueryBuilder;

interface SearchCriteriaBuilderInterface
{
    /**
     * @param QueryBuilder $queryBuilder
     * @param array $params
     * @return QueryBuilder
     */
    public function build(QueryBuilder $queryBuilder, array $params);
}