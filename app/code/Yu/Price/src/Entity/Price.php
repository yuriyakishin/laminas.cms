<?php

namespace Yu\Price\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Price
 *
 * @ORM\Table(name="price", indexes={@ORM\Index(name="path_id", columns={"path_id"}), @ORM\Index(name="currency_id", columns={"currency_id"}), @ORM\Index(name="main", columns={"main"}), @ORM\Index(name="site_id", columns={"site_id"}), @ORM\Index(name="path", columns={"path"}), @ORM\Index(name="value", columns={"value"})})
 * @ORM\Entity(repositoryClass="\Yu\Price\Repository\PriceRepository")
 */
class Price
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, options={"unsigned"=true}, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="site_id", type="integer", precision=0, scale=0, nullable=false, options={"unsigned"=true}, unique=false)
     */
    private $siteId;

    /**
     * @var int
     *
     * @ORM\Column(name="path_id", type="integer", precision=0, scale=0, nullable=false, options={"unsigned"=true}, unique=false)
     */
    private $pathId;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=20, precision=0, scale=0, nullable=false, unique=false)
     */
    private $path;

    /**
     * @var int
     *
     * @ORM\Column(name="main", type="integer", precision=0, scale=0, nullable=false, options={"unsigned"=true,"comment"="Основная валюта"}, unique=false)
     */
    private $main;

    /**
     * @var int
     *
     * @ORM\Column(name="currency_id", type="integer", precision=0, scale=0, nullable=false, options={"unsigned"=true}, unique=false)
     */
    private $currencyId;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="decimal", precision=10, scale=0, nullable=false, unique=false)
     */
    private $value;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set siteId.
     *
     * @param int $siteId
     *
     * @return Price
     */
    public function setSiteId($siteId)
    {
        $this->siteId = $siteId;

        return $this;
    }

    /**
     * Get siteId.
     *
     * @return int
     */
    public function getSiteId()
    {
        return $this->siteId;
    }

    /**
     * Set pathId.
     *
     * @param int $pathId
     *
     * @return Price
     */
    public function setPathId($pathId)
    {
        $this->pathId = $pathId;

        return $this;
    }

    /**
     * Get pathId.
     *
     * @return int
     */
    public function getPathId()
    {
        return $this->pathId;
    }

    /**
     * Set path.
     *
     * @param string $path
     *
     * @return Price
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set main.
     *
     * @param int $main
     *
     * @return Price
     */
    public function setMain($main)
    {
        $this->main = $main;

        return $this;
    }

    /**
     * Get main.
     *
     * @return int
     */
    public function getMain()
    {
        return $this->main;
    }

    /**
     * Set currencyId.
     *
     * @param int $currencyId
     *
     * @return Price
     */
    public function setCurrencyId($currencyId)
    {
        $this->currencyId = $currencyId;

        return $this;
    }

    /**
     * Get currencyId.
     *
     * @return int
     */
    public function getCurrencyId()
    {
        return $this->currencyId;
    }

    /**
     * Set value.
     *
     * @param string $value
     *
     * @return Price
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value.
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}
