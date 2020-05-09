<?php

namespace Yu\Core\Filter;

use Laminas\Filter\DateTimeFormatter;
use Laminas\Filter\AbstractFilter;

class StringToDateTime extends AbstractFilter
{
    public function filter($value)
    {
        $filretDateTime = new DateTimeFormatter($this->getOptions());
        $valueDateTime = $filretDateTime->filter($value);
        $date = new \DateTime($valueDateTime);
        return $date;
    }
}