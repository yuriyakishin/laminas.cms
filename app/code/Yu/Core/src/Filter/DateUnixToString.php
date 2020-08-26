<?php


namespace Yu\Core\Filter;

use Laminas\Filter\AbstractFilter;


class DateUnixToString extends AbstractFilter
{
    public function filter($value)
    {
        $result = date('d-m-Y',$value);
        return $result;
    }
}