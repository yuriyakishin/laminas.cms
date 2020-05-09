<?php

namespace Yu\Admin\Service\Form;

use Laminas\Form\Form;
use Yu\Core\DataHelper;

class FormModel extends Form
{
    /**
     * @var $this
     */
    private static $instance;

    /**
     * @var TabModel[]
     */
    private $tabs = [];

    /**
     * Form config
     * @var array
     */
    private $config;

    /**
     * @var array
     */
    private $fieldsetsConfig = [];

    /**
     * @return FormModel
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new static;
        }
        return self::$instance;
    }

    /**
     * @param array $tab
     */
    public function addTab(array $tab)
    {
        $this->tabs[] = $tab;
    }

    /**
     * @return TabModel[]
     */
    public function getTabs()
    {
        return $this->tabs;
    }

    /**
     * @param array $tabs
     */
    public function setTabs(array $tabs)
    {
        $this->tabs = $tabs;
    }

    /**
     * @param string $fieldsetName
     * @param mixed $data
     */
    public function setDataToFieldset(string $fieldsetName, $data)
    {
        if(is_object($data)) {
            $hydrator = new \Laminas\Hydrator\ClassMethodsHydrator();
            $dataArray = $hydrator->extract($data);
            $dataForForm = [];
            foreach ($dataArray as $key => $value)
            {
                $dataForForm[$key] = DataHelper::prepareDataForForm($value);
            }
            $this->setData([$fieldsetName => $dataForForm]);
            return $this;
        }

        $this->setData([$fieldsetName => $data]);
        return $this;
    }
/*
    public function importDataToObject(string $fieldsetName, $object)
    {
        $data = $this->getData();
        $hydrator = new \Laminas\Hydrator\ClassMethodsHydrator();
        $data1 = $hydrator->hydrate($data[$fieldsetName], $object);

        return $object;
    }
*/
    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * @param array $config
     */
    public function setConfig(array $config): void
    {
        $this->config = $config;
    }

    /**
     * @return array
     */
    public function getFieldsetsConfig(string $fieldsetName = ''): array
    {
        if(empty($fieldsetName)) {
            return $this->fieldsetsConfig;
        } else {
            return $this->fieldsetsConfig[$fieldsetName];
        }
    }

    /**
     * @param array $fieldsetsConfig
     */
    public function setFieldsetsConfig(array $fieldsetsConfig, string $fieldsetName = ''): void
    {
        if(empty($fieldsetName)) {
            $this->fieldsetsConfig = $fieldsetsConfig;
        } else {
            $this->fieldsetsConfig[$fieldsetName] = $fieldsetsConfig;
        }
    }

}