<?php

namespace Yu\Admin\Model;

use Laminas\Form\Form;

class TableModel
{
    /**
     * @var string
     */
    private $tableName;

    /**
     * @var array
     */
    private $columns = [];

    /**
     * @var array
     */
    private $options = [];

    /**
     * @var null|Form;
     */
    private $filter;

    /**
     * TableModel constructor.
     * @param string $tableName
     */
    public function __construct(string $tableName)
    {
        $this->tableName = $tableName;
    }

    /**
     * @return string
     */
    public function getTableName(): string
    {
        return $this->tableName;
    }

    /**
     * @param string $tableName
     */
    public function setTableName(string $tableName): void
    {
        $this->tableName = $tableName;
    }

    /**
     * @return array
     */
    public function getColumns(): array
    {
        return $this->columns;
    }

    /**
     * @param array $columns
     */
    public function setColumns(array $columns): void
    {
        $this->columns = $columns;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param array $options
     * @return $this
     */
    public function setOptions(array $options)
    {
        $this->options = array_merge_recursive($this->options, $options);

        return $this;
    }

    /**
     * @return string
     */
    public function getRoute()
    {
        return $this->options['route'];
    }

    /**
     * @return Form|null
     */
    public function getFilter(): ?Form
    {
        return $this->filter;
    }

    /**
     * @param Form|null $filter
     */
    public function setFilter(?Form $filter): void
    {
        $this->filter = $filter;
    }

}