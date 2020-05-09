<?php

namespace Yu\Realty\Service;

class RealtyConfigManager
{
    /**
     * @var array
     */
    private $config;

    /**
     * @var string
     */
    private $realtyType;

    /**
     * RealtyConfigManager constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @param string $realtyType
     * @return $this
     */
    public function setRealtyType(string $realtyType)
    {
        $this->realtyType = $realtyType;
        return $this;
    }

    /**
     * Return realty object config
     *
     * @param string|null $realtyType
     * @return mixed
     */
    public function getRealtyConfig(string $realtyType = null)
    {
        if($realtyType === null) {
            $realtyType = $this->realtyType;
        }

        return $this->config[$realtyType];
    }

    /**
     * @param string|null $realtyType
     * @return mixed
     */
    public function getRealtyAdminOptions(string $realtyType = null)
    {
        if($realtyType === null) {
            $realtyType = $this->realtyType;
        }

        $options = $this->config[$realtyType]['admin']['options'];

        return $options;
    }

    /**
     * @param string|null $realtyType
     * @return mixed
     */
    public function getRealtyAttributes(string $realtyType = null)
    {
        if($realtyType === null) {
            $realtyType = $this->realtyType;
        }

        $attributes = $this->config[$realtyType]['attributes'];

        return $attributes;
    }
}