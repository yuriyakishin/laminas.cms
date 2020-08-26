<?php

namespace Yu\Eav\Entity;

interface EavValueInterface
{
    /**
     * @param int $entityId
     * @return mixed
     */
    public function setEntityId(int $entityId);

    /**
     * @param int $attributeId
     * @return mixed
     */
    public function setAttributeId(int $attributeId);

    /**
     * @param null $value
     * @return mixed
     */
    public function setValue($value = null);

}