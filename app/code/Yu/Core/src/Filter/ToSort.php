<?php

namespace Yu\Core\Filter;

use Laminas\Filter\DateTimeFormatter;
use Laminas\Filter\AbstractFilter;
use Laminas\Filter\ToInt;

class ToSort extends AbstractFilter
{
    public function filter($value)
    {
        $toIntFilter = new ToInt();
        $value = $toIntFilter->filter($value);
        if(empty($value)) {
            $value = 100;
        }
        return $value;
    }
}