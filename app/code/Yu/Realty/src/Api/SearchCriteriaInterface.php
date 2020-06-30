<?php

namespace Yu\Realty\Api;

interface SearchCriteriaInterface
{
    /**
     * @param array|null $params
     * @return $this
     */
    public function setParams(array $params = null);

    /**
     * @return array
     */
    public function getCriteria();

}