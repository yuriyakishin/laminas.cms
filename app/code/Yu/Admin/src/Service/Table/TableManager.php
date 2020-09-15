<?php

namespace Yu\Admin\Service\Table;

use Yu\Admin\Model\TableModel;
use Laminas\Serializer\Serializer;
use Yu\Site\ValueObject\Lang;
use Yu\Core\DataHelper;
use Laminas\Form\Form;

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
     * @var
     */
    private $entityManager;

    /**
     * @var \Laminas\View\Renderer\PhpRenderer
     */
    private $renderer;

    /**
     * Table constructor.
     * @param array $config
     */
    public function __construct(
        array $config,
        $entityManager,
        $renderer
    )
    {
        if (isset($config['admin']['table_manager'])) {
            $this->config = $config['admin']['table_manager'];
        }

        $this->entityManager = $entityManager;
        $this->renderer = $renderer;
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

        if (isset($this->config[$tableName]['filter'])) {
            $filterForm = $this->createFilterForm($tableName);
            $table->setFilter($filterForm);
        }

        $columns = array();
        foreach ($this->config[$tableName]['columns'] as $column) {
            $columns[] = $column;
        }

        $table->setColumns($columns);

        if (isset($this->config[$tableName]['options'])) {
            $table->setOptions($this->config[$tableName]['options']);
        }

        return $table;
    }

    public function createFilterForm(string $tableName)
    {
        $filterConfig = $this->config[$tableName]['filter'];
        $form = new Form();
        foreach ($filterConfig as $elementConfig) {
            if (isset($elementConfig['type']) && $elementConfig['type'] == \DoctrineModule\Form\Element\ObjectSelect::class) {
                $elementConfig['options']['object_manager'] = $this->entityManager;
            }
            $form->add($elementConfig);
        }
        return $form;
    }

    public function retrieveValue($data, $key, $collumn = null)
    {
        $value = '';
        try {
            // Извлекаем значение из $data по ключу $key
            if (is_object($data)) {
                $getterName = 'get' . DataHelper::toCamelCase($key);
                if (method_exists($data, $getterName)) {
                    $value = $data->{$getterName}($key);
                }
            } elseif (is_array($data)) {
                if (isset($data[$key])) {
                    $value = $data[$key];
                }
            }

            if ($collumn !== null && isset($collumn['target_class'])) {
                $emtity = $this->entityManager->getRepository($collumn['target_class'])->findOneBy(['id' => $value]);
                if (method_exists($emtity, 'get' . DataHelper::toCamelCase($collumn['property']))) {
                    $value = $emtity->{'get' . DataHelper::toCamelCase($collumn['property'])}();
                }
            }

            //
            if (isset($collumn['source'])) {
                /** @var \Yu\Core\Api\View\Helper\SourceHelperInterface $helper */
                $helper = $this->renderer->plugin($collumn['source']['view_helper']);
                if (is_array($collumn['source']['options'])) {
                    $helper->setOptions($collumn['source']['options']);
                } elseif (is_callable($collumn['source']['options'])) {
                    $helper->setOptions($collumn['source']['options']($data));
                }
                $value = $helper->getContent();
            }

            // unserialize для сериализованных данных
            if (DataHelper::checkSerializeString($value)) {
                $unserializ = Serializer::unserialize($value);
                if (is_array($unserializ)
                    && isset($unserializ[Lang::getMainLang()['code']])) {
                    $value = $unserializ[Lang::getMainLang()['code']];
                }
            }

            if (isset($collumn['filter'])) {
                $filter = new $collumn['filter'];
                $value = $filter->filter($value);
            }

            if ($key == 'active' || $key == 'main' || $key == 'view') {
                return $value ? 'Да' : 'Нет';
            }
        } catch (\Exception $e) {

        }

        return $value;
    }
}