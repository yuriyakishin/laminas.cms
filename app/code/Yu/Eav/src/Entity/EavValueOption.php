<?php

namespace Yu\Eav\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EavValueOption
 *
 * @ORM\Table(name="eav_value_option", indexes={@ORM\Index(name="sort", columns={"sort"}), @ORM\Index(name="option_id", columns={"option_id"})})
 * @ORM\Entity(repositoryClass="\Yu\Eav\Repository\EavValueOptionRepository")
 */
class EavValueOption
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
     * @ORM\Column(name="option_id", type="integer", precision=0, scale=0, nullable=false, options={"unsigned"=true}, unique=false)
     */
    private $optionId;

    /**
     * @var int
     *
     * @ORM\Column(name="sort", type="integer", precision=0, scale=0, nullable=false, options={"unsigned"=true}, unique=false)
     */
    private $sort;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="text", length=65535, precision=0, scale=0, nullable=false, unique=false)
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
     * Set optionId.
     *
     * @param int $optionId
     *
     * @return EavValueOption
     */
    public function setOptionId($optionId)
    {
        $this->optionId = $optionId;

        return $this;
    }

    /**
     * Get optionId.
     *
     * @return int
     */
    public function getOptionId()
    {
        return $this->optionId;
    }

    /**
     * Set sort.
     *
     * @param int $sort
     *
     * @return EavValueOption
     */
    public function setSort($sort)
    {
        $this->sort = $sort;

        return $this;
    }

    /**
     * Get sort.
     *
     * @return int
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * Set value.
     *
     * @param string $value
     *
     * @return EavValueOption
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