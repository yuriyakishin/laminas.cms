<?php

namespace Yu\Eav\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EavValueInt
 *
 * @ORM\Table(name="eav_value_int", indexes={@ORM\Index(name="site_id", columns={"site_id"}), @ORM\Index(name="attribute_id", columns={"attribute_id"}), @ORM\Index(name="entity_id", columns={"entity_id"}), @ORM\Index(name="value", columns={"value"})})
 * @ORM\Entity(repositoryClass="\Yu\Eav\Repository\EavValueIntRepository")
 */
class EavValueInt implements EavValueInterface
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
     * @var int|null
     *
     * @ORM\Column(name="value", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $value;


    /**
     * Set id.
     *
     * @param int $id
     *
     * @return EavValueInt
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
     * @return EavValueInt
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
     * @return EavValueInt
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
     * @param int|null $value
     *
     * @return EavValueInt
     */
    public function setValue($value = null)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value.
     *
     * @return int|null
     */
    public function getValue()
    {
        return $this->value;
    }
}
