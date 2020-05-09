<?php

namespace Yu\Admin\View\Helper;

use Laminas\View\Helper\AbstractHelper;
use Laminas\Serializer\Serializer;
use Yu\Site\ValueObject\Lang;
use Yu\Core\DataHelper;

class TableHelper extends AbstractHelper
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
     * @var array
     */
    private $columns;

    private $entityManager;

    /**
     * Table constructor.
     * @param array $config
     */
    public function __construct(
        array $config,
        $entityManager
    )
    {
        if (isset($config['admin']['table_manager'])) {
            $this->config = $config['admin']['table_manager'];
        }
        $this->entityManager = $entityManager;
    }

    /**
     * @param string $tableName
     */
    public function setTableName(string $tableName)
    {
        $this->tableName = $tableName;
    }

    /**
     * @return string
     */
    private function getTableName()
    {
        return $this->tableName;
    }

    /**
     * @param string $tableName
     */
    public function createTable(string $tableName)
    {
        $this->setTableName($tableName);

        foreach ($this->config[$tableName]['columns'] as $column) {
            $this->columns[] = $column;
        }
    }

    public function retrieveValue($data, $key, $collumn = null)
    {
        $value = '';
        // Извлекаем значение из $data по ключу $key
        if (is_object($data)) {
            $getterName = 'get' . DataHelper::toCamelCase($key);
            if (method_exists($data, $getterName)) {
                $value = $data->{$getterName}($key);
            }
        } elseif(is_array($data)) {
            if(isset($data[$key])) {
                $value = $data[$key];
            }
        }

        if($collumn !== null && isset($collumn['target_class'])) {
            $emtity = $this->entityManager->getRepository($collumn['target_class'])->findOneBy(['id' => $value]);
            $value = $emtity->{'get' . DataHelper::toCamelCase($collumn['property'])}();
        }

        //
        if(isset($collumn['source'])) {
            /** @var \Yu\Core\Api\View\Helper\SourceHelperInterface $helper */
            $helper = $this->getView()->plugin($collumn['source']['view_helper']);
            if(is_array($collumn['source']['options'])) {
                $helper->setOptions($collumn['source']['options']);
            } elseif(is_callable($collumn['source']['options'])) {
                $helper->setOptions($collumn['source']['options']($data));
            }
            $value = $helper->getContent();
        }

        // unserialize для сериализованных данных
        if (DataHelper::checkSerializeString($value)) {
            $unserializ = Serializer::unserialize($value);
            if(is_array($unserializ)
                && isset($unserializ[Lang::getMainLang()['code']])) {
                $value = $unserializ[Lang::getMainLang()['code']];
            }
        }

        if(isset($collumn['filter'])) {
            $filter = new $collumn['filter'];
            $value = $filter->filter($value);
        }

        if($key == 'active') {
            return $value ? 'Да' : 'Нет';
        }

        return $value;
    }
}