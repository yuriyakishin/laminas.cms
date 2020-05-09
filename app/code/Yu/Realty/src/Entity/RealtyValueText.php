<?php

namespace Yu\Realty\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RealtyValueText
 *
 * @ORM\Table(name="realty_value_text", indexes={@ORM\Index(name="attribute_id", columns={"attribute_id"}), @ORM\Index(name="entity_id", columns={"entity_id"})})
 * @ORM\Entity(repositoryClass="\Yu\Realty\Repository\RealtyValueTextRepository")
 */
class RealtyValueText implements RealtyValueInterface
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
     * @ORM\Column(name="entity_id", type="integer", precision=0, scale=0, nullable=false, options={"unsigned"=true}, unique=false)
     */
    private $entityId;

    /**
     * @var int
     *
     * @ORM\Column(name="attribute_id", type="integer", precision=0, scale=0, nullable=false, options={"unsigned"=true}, unique=false)
     */
    private $attributeId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="value", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $value;

    /**
     * Set id.
     *
     * @param int $id
     *
     * @return RealtyValueText
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

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
     * Set entityId.
     *
     * @param int $entityId
     *
     * @return RealtyValueText
     */
    public function setEntityId($entityId)
    {
        $this->entityId = $entityId;

        return $this;
    }

    /**
     * Get entityId.
     *
     * @return int
     */
    public function getEntityId()
    {
        return $this->entityId;
    }

    /**
     * Set attributeId.
     *
     * @param int $attributeId
     *
     * @return RealtyValueText
     */
    public function setAttributeId($attributeId)
    {
        $this->attributeId = $attributeId;

        return $this;
    }

    /**
     * Get attributeId.
     *
     * @return int
     */
    public function getAttributeId()
    {
        return $this->attributeId;
    }

    /**
     * Set value.
     *
     * @param string|null $value
     *
     * @return RealtyValueText
     */
    public function setValue($value = null)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value.
     *
     * @return string|null
     */
    public function getValue()
    {
        return $this->value;
    }
}
