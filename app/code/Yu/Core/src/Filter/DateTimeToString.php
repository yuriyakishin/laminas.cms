<?php

namespace Yu\Core\Filter;

use Laminas\Filter\DateTimeFormatter;
use Laminas\Filter\AbstractFilter;


class DateTimeToString extends AbstractFilter
{
    public function filter($value)
    {
        $result = $value->format('d-m-Y');
        return $result;
    }
}