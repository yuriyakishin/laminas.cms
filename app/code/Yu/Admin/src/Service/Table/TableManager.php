<?php

namespace Yu\Admin\Service\Table;

use Yu\Admin\Model\TableModel;

class TableManager
{
    /**
     * @var string
     */
    private $tableName;

    /**
     * @var array|mixed
     */
    private $config = [];

    /**
     * Table constructor.
     * @param array $config
     */
    public function __construct(
        array $config
    )
    {
        if (isset($config['admin']['table_manager'])) {
            $this->config = $config['admin']['table_manager'];
        }
    }

    /**
     * @param array $config
     */
    public function setConfig(array $config)
    {
        $this->config = \Laminas\Stdlib\ArrayUtils::merge($this->config, $config);
    }

    /**
     * @param string $tableName
     * @return TableModel
     */
    public function createTable(string $tableName)
    {
        $table = new TableModel($tableName);

        $columns = array();
        foreach ($this->config[$tableName]['columns'] as $column) {
            $columns[] = $column;
        }

        $table->setColumns($columns);

        if(isset($this->config[$tableName]['options'])) {
            $table->setOptions($this->config[$tableName]['options']);
        }

        return $table;
    }
}