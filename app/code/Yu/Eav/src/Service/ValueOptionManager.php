<?php

namespace Yu\Eav\Service;

use Yu\Eav\Model\ValueOption;

class ValueOptionManager
{
    /**
     * @var array
     */
    private $configEav;

    /**
     * ValueOptionManager constructor.
     * @param array $config
     */
    public function __construct(
        array $config
    )
    {
        $this->configEav = $config;
    }

    /**
     * @param string $type
     * @return ValueOption
     */
    public function createModel(string $type)
    {
        $model = new ValueOption();
        $model->setId($this->configEav['value-option'][$type]['id']);
        $model->setCode($this->configEav['value-option'][$type]['code']);
        $model->setLabel($this->configEav['value-option'][$type]['label']);

        return $model;
    }

}