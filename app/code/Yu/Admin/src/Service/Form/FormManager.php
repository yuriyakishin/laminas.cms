<?php

namespace Yu\Admin\Service\Form;

use Laminas\Form\Fieldset;
use Laminas\Form\Element;
use Laminas\Serializer\Adapter;
use Laminas\Serializer\Exception;
use Laminas\Serializer\Serializer;
use Yu\Admin\Model\TabModel;
use Yu\Site\ValueObject\Lang;
use Yu\Core\DataHelper;

class FormManager
{
    /**
     * @var array|mixed
     */
    private $config = [];

    /**
     * @var array|mixed
     */
    private $configForm = [];

    /**
     * @var FormModel
     */
    private $form;

    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $entityManager;

    /**
     * FormManager constructor.
     * @param FormModel $form
     * @param array $config
     * @param $entityManager
     */
    public function __construct(
        FormModel $form,
        array $config,
        $entityManager
    )
    {
        $this->form = $form;
        $this->config = $config;
        $this->entityManager = $entityManager;
        if (isset($config['admin']['form_manager']['forms'])) {
            $this->configForm = $config['admin']['form_manager']['forms'];
        }
    }

    /**
     * @param array $config
     */
    public function setConfig(array $config)
    {
        $this->configForm = \Laminas\Stdlib\ArrayUtils::merge($this->configForm, $config);
        //var_dump($this->configForm);die;
    }

    /**
     * @param string $formName
     * @return FormModel
     */
    public function getForm(string $formName)
    {
        if (!empty($this->form) || $this->form->getName() !== $formName) {
            $this->createForm($formName);
        }

        return $this->form;
    }

    /**
     * @param $formName
     * @return $this
     */
    private function createForm($formName)
    {
        $this->form->setAttributes([
                'action' => $this->configForm[$formName]['action'],
                'method' => 'post',
                'id' => $formName,
            ]
        );

        if (isset($this->configForm[$formName]['lang'])) {
            $this->form->setOption('lang', $this->configForm[$formName]['lang']);
        }

        if (isset($this->configForm[$formName]['route-back'])) {
            $this->form->setOption('route-back', $this->configForm[$formName]['route-back']);
        }

        // create tabs
        $tabs = array();
        foreach ($this->configForm[$formName]['tabs'] as $nameTab => $dataTab) {
            $tab = new TabModel();
            $tab->setName($nameTab);
            $tab->setLabel($dataTab['label']);
            $tab->setSort(((isset($dataTab['sort'])) ? $dataTab['sort'] : 0));

            // create fieldsets
            foreach ($dataTab['fieldsets'] as $nameFieldset => $dataFieldset) {

                if (is_string($dataFieldset)) {
                    $dataFieldset = $this->config['admin']['form_manager']['fieldsets'][$dataFieldset];
                }

                if (is_array($dataFieldset) && isset($dataFieldset['fieldset'])) {
                    $dataFieldset = \Laminas\Stdlib\ArrayUtils::merge($dataFieldset, $this->config['admin']['form_manager']['fieldsets'][$dataFieldset['fieldset']]);
                }

                $this->form->setFieldsetsConfig($dataFieldset, $nameFieldset);

                $tab->addFieldsetName($nameFieldset);
                $fieldset = new Fieldset($nameFieldset);

                if (isset($dataFieldset['options'])) {
                    $fieldset->setOptions($dataFieldset['options']);
                }

                if (isset($dataFieldset['use_as_base_fieldset'])) {
                    $fieldset->setUseAsBaseFieldset($dataFieldset['use_as_base_fieldset']);
                }

                // create elements
                foreach ($dataFieldset['elements'] as $elementConfig) {
                    if (isset($elementConfig['type']) && $elementConfig['type'] == \DoctrineModule\Form\Element\ObjectSelect::class) {
                        $elementConfig['options']['object_manager'] = $this->entityManager;
                    }
                    if (!empty($elementConfig['lang'])) {
                        $fieldsetLang = new Fieldset($elementConfig['name']);
                        foreach (Lang::getLangs() as $lang) {
                            $dataElementLang = $elementConfig;
                            $dataElementLang['name'] = $lang['code'];
                            $dataElementLang['options']['lang'] = $lang['code'];
                            $fieldsetLang->add($dataElementLang);
                            $fieldset->add($fieldsetLang);
                        }
                    } else {
                        $fieldset->add($elementConfig);
                    }
                }

                $this->form->add($fieldset);
            }

            $tabs[] = $tab;
        }

        $this->form->setConfig($this->configForm);
        $this->form->setTabs($tabs);

        return $this;
    }

    /**
     * @param FormModel $form
     * @param string $fieldsetName
     * @param object $entity
     * @return object
     */
    public function importDataToEntity(FormModel $form, string $fieldsetName, object $entity)
    {
        $data = $form->getData()[$fieldsetName];

        $fieldsetConfig = $form->getFieldsetsConfig($fieldsetName);
        $serializer = Serializer::factory(Adapter\PhpSerialize::class);

        foreach ($fieldsetConfig["elements"] as $elementConfig) {

            $setterName = 'set' . DataHelper::toCamelCase($elementConfig['name']);

            $value = '';
            if (method_exists($entity, $setterName)) {
                if (!empty($elementConfig['lang'])) {
                    $_value = array();
                    $_value = $data[$elementConfig['name']];
                    $value = $serializer->serialize($_value);
                } else {
                    $value = $data[$elementConfig['name']];
                }

                if (isset($elementConfig['filters'])) {
                    foreach ($elementConfig['filters'] as $filterConfig) {
                        $filterOptions = isset($filterConfig['options']) ? $filterConfig['options'] : null;
                        /**
                         * @var \Laminas\Filter\FilterInterface $filter
                         */
                        $filter = new $filterConfig['name']($filterOptions);
                        $value = $filter->filter($value);
                    }
                }

                $entity->{$setterName}($value);

            }

        }
        return $entity;
    }

    /**
     * @param FormModel $form
     * @param string $fieldsetName
     * @param $data
     * @return FormModel
     */
    public function setDataToFieldset(FormModel $form, string $fieldsetName, $data)
    {
        $dataArray = [];

        if (is_object($data)) {
            $hydrator = new \Laminas\Hydrator\ClassMethodsHydrator();
            $dataArray = $hydrator->extract($data);
        } else {
            $dataArray = $data;
        }

        if(!empty($dataArray)) {
            $dataForForm = [];
            foreach ($dataArray as $key => $value) {
                $dataForForm[$key] = DataHelper::prepareDataForForm($value);
            }
            $form->setData([$fieldsetName => $dataForForm]);
        }
        return $form;
    }
}