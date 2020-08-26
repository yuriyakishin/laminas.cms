<?php

namespace Yu\Board\Controller\Admin;

use Yu\Admin\Controller\AbstractAdminController;
use Laminas\View\Model\ViewModel;
use Yu\Board\Entity\BoardCity;

class BoardCityController extends AbstractAdminController
{
    public function indexAction()
    {
        $entities = $this->entityManager()->getRepository(BoardCity::class)->findAll();
        //echo $pages; die;
        $table = $this->tableManager()->createTable('board-city');
        $table->setOptions(['route' => 'admin/board-city']);

        $this->layout()->setVariable('h1','Города объявлений');
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
        $form = $this->formManager()->getForm('board-city');
        $entity = $this->entityManager()->getRepository(BoardCity::class)->findOneById($id);

        $this->formManager()->setDataToFieldset($form,'main',$entity);

        if(empty($id)) {
            $this->layout()->setVariable('h1', 'Создание города');
        } else {
            $this->layout()->setVariable('h1', 'Редактирование города');
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
            $form = $this->formManager()->getForm('board-city');

            $form->setData($data);

            if ($form->isValid()) {
                try {
                    $id = (int)$data['main']['id'] ?? 0;

                    $repository = $this->entityManager()->getRepository(BoardCity::class);

                    $entity = $repository->findOneById($id);
                    if(empty($entity)) {
                        $entity = new BoardCity();
                    }
                    $this->formManager()->importDataToEntity($form, 'main', $entity);
                    $id = $repository->save($entity);

                    $this->flashMessenger()->addSuccessMessage("Данные сохранены");
                    if (empty($data['save_end_close'])) {
                        return $this->redirect()->toRoute('admin/board-city/edit', ['id' => $id]);
                    }
                } catch (\Exception $e) {
                    //var_dump($form->getData());die;
                    $this->flashMessenger()->addErrorMessage("Ошибка записи в базу данных: " . $e->getMessage());
                    return $this->redirect()->toRoute('admin/board-city/edit', $form->getData());
                }
            }
        }
        return $this->redirect()->toRoute('admin/board-city');
    }

    public function deleteAction()
    {
        $id = $this->getRequest()->getQuery('id');
        if(!empty($id))
        {
            $entity = $this->entityManager()->getRepository(BoardCity::class)->findOneById($id);
            $this->entityManager()->getRepository(BoardCity::class)->remove($entity);
        }
        $this->layout()->setTerminal(true);

        return $this->getResponse();
    }
}