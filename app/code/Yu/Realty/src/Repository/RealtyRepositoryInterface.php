<?php

namespace Yu\Realty\Repository;

interface RealtyRepositoryInterface
{
    /**
     * @param array|null $criteria
     * @return mixed
     */
    public function findRealty(array $criteria = null);
}