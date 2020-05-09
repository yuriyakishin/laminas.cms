<?php

namespace Yu\Price\Controller\Admin;

use Yu\Admin\Controller\AbstractAdminController;
use Laminas\View\Model\ViewModel;
use Yu\Price\Entity\Currency;

class CurrencyController extends AbstractAdminController
{
    /**
     * @var \Yu\Admin\Service\Table\TableManager
     */
    private $tableManager;

    /**
     * @var \Yu\Admin\Service\Form\FormManager
     */
    private $formManager;

    /**
     * PageController constructor.
     * @param \Yu\Admin\Service\TableManager $tableManager
     */
    public function __construct(
        \Yu\Admin\Service\Table\TableManager $tableManager,
        \Yu\Admin\Service\Form\FormManager $formManager
    )
    {
        $this->tableManager = $tableManager;
        $this->formManager = $formManager;
    }

    public function indexAction()
    {
        $entities = $this->entityManager()->getRepository(Currency::class)->findAll();
        //echo $pages; die;
        $table = $this->tableManager->createTable('currency');
        $table->setOptions(['route' => 'admin/currency']);

        $this->layout()->setVariable('h1','Валюты');
        $view = new ViewModel();
        $view->setTemplate('admin/table');
        $view->setVariable('table',$table);
        $view->setVariable('rowsData',$entities);
        return $view;
    }

    public function editAction()
    {
        $id = $this->params('id',0);
        /** @var \Yu\Admin\Service\Form\FormModel $form */
        $form = $this->formManager->getForm('currency');
        $currency = $this->entityManager()->getRepository(Currency::class)->findOneById($id);

        $this->formManager->setDataToFieldset($form,'main',$currency);

        if(empty($id)) {
            $this->layout()->setVariable('h1', 'Добавить валюту');
        } else {
            $this->layout()->setVariable('h1', 'Редактирование валюту');
        }
        $view = new ViewModel();
        $view->setTemplate('admin/form');
        $view->setVariable('form', $form);
        return $view;
    }

    public function saveAction()
    {
        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            /** @var \Yu\Admin\Service\Form\FormModel $form */
            $form = $this->formManager->getForm('currency');

            $form->setData($data);

            if ($form->isValid()) {
                try {
                    $id = (int)$data['main']['id'] ?? 0;

                    $currencyRepository = $this->entityManager()->getRepository(Currency::class);
                    /** @var \Yu\Content\Entity\Page $page */
                    $currency = $currencyRepository->findOneById($id);
                    if(empty($currency)) {
                        $currency = new Currency();
                    }
                    $this->formManager->importDataToEntity($form, 'main', $currency);
                    $id = $currencyRepository->save($currency);

                    $this->flashMessenger()->addSuccessMessage("Данные сохранены");
                    if (empty($data['save_end_close'])) {
                        return $this->redirect()->toRoute('admin/currency/edit', ['id' => $id]);
                    }
                } catch (\Exception $e) {
                    //var_dump($form->getData());die;
                    $this->flashMessenger()->addErrorMessage("Ошибка записи в базу данных: " . $e->getMessage());
                    return $this->redirect()->toRoute('admin/currency/edit', $form->getData());
                }
            }
        }
        return $this->redirect()->toRoute('admin/currency');
    }

    public function deleteAction()
    {
        $id = $this->getRequest()->getQuery('id');
        if(!empty($id))
        {
            $entity = $this->entityManager()->getRepository(Currency::class)->findOneById($id);
            $this->entityManager()->getRepository(Currency::class)->remove($entity);
        }
        $this->layout()->setTerminal(true);

        return $this->getResponse();
    }
}