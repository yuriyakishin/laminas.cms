<?php

namespace Yu\Admin\Model;

class TabModel
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $sort;

    /**
     * @var string[]
     */
    private $fieldsetNames;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return string[]
     */
    public function getFieldsetNames(): array
    {
        return $this->fieldsetNames;
    }

    /**
     * @param string[] $fieldsetNames
     */
    public function setFieldsetNames(array $fieldsetNames): void
    {
        $this->fieldsetNames = $fieldsetNames;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function addFieldsetName(string $name)
    {
        $this->fieldsetNames[] = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     */
    public function setLabel($label): void
    {
        $this->label = $label;
    }

    /**
     * @return mixed
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * @param mixed $sort
     */
    public function setSort($sort): void
    {
        $this->sort = $sort;
    }


}