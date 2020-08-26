<?php


namespace Yu\Core\Filter;

use Laminas\Filter\AbstractFilter;
use Laminas\Filter\DateTimeFormatter;

class DateTimeToUnixFormat extends AbstractFilter
{
    public function filter($value)
    {
        $filretDateTime = new DateTimeFormatter($this->getOptions());
        $valueDateTime = $filretDateTime->filter($value);
        $date = new \DateTime($value);
        return $date->format('U');
    }
}