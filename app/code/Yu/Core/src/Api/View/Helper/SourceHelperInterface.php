<?php

namespace Yu\Core\Api\View\Helper;

interface SourceHelperInterface
{
    /**
     * @param array $options
     * @return mixed
     */
    public function setOptions(array $options);

    /**
     * @return string
     */
    public function getContent();
}