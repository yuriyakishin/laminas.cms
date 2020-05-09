<?php

namespace Yu\Eav\Controller\Admin;

use Laminas\View\Model\ViewModel;
use Yu\Seo\Entity\Meta;
use Yu\Admin\Controller\AbstractAdminController;
use Yu\Eav\Model\ValueOption;
use Yu\Eav\Service\ValueOptionManager;
use Yu\Eav\Entity\EavValueOption;

class ValueOptionController extends AbstractAdminController
{
    /**
     * @var array
     */
    private $options;

    /**
     * @var \Yu\Eav\Model\ValueOption
     */
    private $valueOptionModel;

    /**
     * ValueOptionController constructor.
     * @param array $options
     */
    public function __construct(
        array $options
    )
    {
        $this->options = $options;
    }

    public function indexAction()
    {
        $this->valueOptionModel = $this->valueOptionManager()->createModel($this->options['option-value']);

        $entities = $this->entityManager()->getRepository(EavValueOption::class)->findBy([
            'optionId' => $this->valueOptionModel->getId(),
        ], [
            'sort' => 'ASC',
        ]);

        if (isset($this->options['table'])) {
            $table = $this->tableManager()->createTable($this->options['table']);
        } else {
            $table = $this->tableManager()->createTable('eav-value-option');
        }

        $this->layout()->setVariable('h1', $this->options['title']);
        $view = new ViewModel();
        $view->setTemplate('admin/table');
        $view->setVariable('table', $table);
        $view->setVariable('rowsData', $entities);
        return $view;
    }

    public function editAction()
    {
        $id = $this->params('id', 0);
        /** @var \Yu\Admin\Service\Form\FormModel $form */
        $form = $this->formManager()->getForm('eav-value-option');

        $entity = $this->entityManager()->getRepository(EavValueOption::class)->findOneById($id);

        $this->formManager()->setDataToFieldset($form, 'main', $entity);

        if (empty($id)) {
            $this->layout()->setVariable('h1', $this->options['title'] . ' - Добавить');
        } else {
            $this->layout()->setVariable('h1', $this->options['title'] . ' - Редактировать');
        }
        $view = new ViewModel();
        $view->setTemplate('admin/form');
        $view->setVariable('form', $form);
        return $view;
    }

    public function saveAction()
    {
        if ($this->getRequest()->isPost()) {

            $this->valueOptionModel = $this->valueOptionManager()->createModel($this->options['option-value']);

            $data = $this->params()->fromPost();
            /** @var \Yu\Admin\Service\Form\FormModel $form */
            $form = $this->formManager()->getForm('eav-value-option');

            $form->setData($data);

            if ($form->isValid()) {
                try {
                    $id = (int)$data['main']['id'] ?? 0;

                    /** @var \Yu\Eav $repository */
                    $repository = $this->entityManager()->getRepository(EavValueOption::class);
                    /** @var \Yu\Eav\Entity\EavValueOption $entity */
                    $entity = $repository->findOneById($id);
                    if (empty($entity)) {
                        $entity = new EavValueOption();
                    }

                    $this->formManager()->importDataToEntity($form, 'main', $entity);

                    $entity->setOptionId($this->valueOptionModel->getId());
                    $id = $repository->save($entity);

                    $this->flashMessenger()->addSuccessMessage("Данные сохранены");
                    if (empty($data['save_end_close'])) {
                        return $this->redirect()->toRoute($this->options['route'] . '/edit', ['id' => $id]);
                    }
                } catch (\Exception $e) {
                    //var_dump($form->getData());die;
                    $this->flashMessenger()->addErrorMessage("Ошибка записи в базу данных: " . $e->getMessage());
                    return $this->redirect()->toRoute($this->options['route'] . '/edit', $form->getData());
                }
            }
        }
        return $this->redirect()->toRoute($this->options['route']);
    }

    public function deleteAction()
    {
        $id = $this->getRequest()->getQuery('id');
        if (!empty($id)) {
            $entity = $this->entityManager()->getRepository(EavValueOption::class)->findOneById($id);
            $this->entityManager()->getRepository(EavValueOption::class)->remove($entity);
        }
        $this->layout()->setTerminal(true);

        return $this->getResponse();
    }
}