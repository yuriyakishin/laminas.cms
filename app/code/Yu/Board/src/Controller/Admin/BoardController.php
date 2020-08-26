<?php

namespace Yu\Board\Controller\Admin;

use Yu\Admin\Controller\AbstractAdminController;
use Laminas\View\Model\ViewModel;
use Laminas\View\Model\JsonModel;
use Laminas\Paginator\Paginator;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrinePaginatorAdapter;
use Yu\Board\Entity\Board;

class BoardController extends AbstractAdminController
{
    public function indexAction()
    {
        $entities = $this->entityManager()->getRepository(Board::class)->findBy([],['id' => 'DESC']);
        //echo $pages; die;
        $table = $this->tableManager()->createTable('board');
        $table->setOptions(['route' => 'admin/board']);

        $this->layout()->setVariable('h1', 'Объявления');
        $view = new ViewModel();
        $view->setTemplate('admin/table-ajax');
        $view->setVariable('table', $table);
        $view->setVariable('rowsData', $entities);
        return $view;
    }

    public function editAction()
    {
        $id = $this->params('id', 0);
        /** @var \Yu\Admin\Service\Form\FormModel $form */
        $form = $this->formManager()->getForm('board');

        $board = $this->entityManager()->getRepository(Board::class)->findOneById($id);

        $this->formManager()->setDataToFieldset($form, 'board', $board);

        if (empty($id)) {
            $this->layout()->setVariable('h1', 'Создание объявления');
        } else {
            $this->layout()->setVariable('h1', 'Редактирование объявления');
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
            $form = $this->formManager()->getForm('board');

            $form->setData($data);

            if ($form->isValid()) {
                try {
                    $id = (int)$data['board']['id'] ?? 0;

                    $repository = $this->entityManager()->getRepository(Board::class);

                    $entity = $repository->findOneById($id);
                    $this->formManager()->importDataToEntity($form, 'board', $entity);
                    $id = $repository->save($entity);

                    $this->flashMessenger()->addSuccessMessage("Данные сохранены");
                    if (empty($data['save_end_close'])) {
                        return $this->redirect()->toRoute('admin/board/edit', ['id' => $id]);
                    }
                } catch (\Exception $e) {
                    //var_dump($form->getData());die;
                    $this->flashMessenger()->addErrorMessage("Ошибка записи в базу данных: " . $e->getMessage());
                    return $this->redirect()->toRoute('admin/board/edit', $form->getData());
                }
            }
        }
        return $this->redirect()->toRoute('admin/board');
    }

    public function deleteAction()
    {
        $id = $this->getRequest()->getQuery('id');
        if (!empty($id)) {
            $entity = $this->entityManager()->getRepository(Board::class)->findOneById($id);
            $this->entityManager()->getRepository(Board::class)->remove($entity);
        }
        $this->layout()->setTerminal(true);

        return $this->getResponse();
    }

    public function ajaxAction()
    {
        /*$draw = $this->getRequest()->getQuery('draw');
        $start = $this->getRequest()->getQuery('start');
        $length = $this->getRequest()->getQuery('length');
        $currentPage = intdiv($start, $length)+1;

        $repository = $this->entityManager()->getRepository(Board::class);
        $query = $repository->getQuery();

        // Создаем пагинатор.
        $ormPaginator = new ORMPaginator($query, false);
        $ormPaginator->setUseOutputWalkers(false);
        $adapter = new DoctrinePaginatorAdapter($ormPaginator);
        $paginator = new Paginator($adapter);

        $paginator->setCurrentPageNumber($currentPage);
        $paginator->setDefaultItemCountPerPage($length);

        $count = $paginator->getTotalItemCount();
        $data = array();
        $result = [
            "draw" => $draw,
            "recordsTotal" => $count,
            "recordsFiltered" => $count,
        ];

        $table = $this->tableManager()->createTable('board');

        foreach ($paginator as $row) {
            foreach ($table->getColumns() as $collumn) {
                $_data[$collumn['key']] = (string)$this->tableManager()->retrieveValue($row, $collumn['key'], $collumn);
            }

            $_data['edit'] = '<button type="button" class="btn btn-edit btn-flat btn-sm button-edit" data-id="'.$this->tableManager()->retrieveValue($row, 'id').'"><i class="fas fa-edit"></i></button>';
            $_data['delete'] = '<button type="button" class="btn btn-danger btn-flat btn-sm button-delete" data-id="'.$this->tableManager()->retrieveValue($row, 'id').'"><i class="fas fa-trash"></i></button>';

            $data[] = $_data;
        }

        $result["data"] = $data;

        $json = new JsonModel($result);
        return $json;*/
        $params = $this->getRequest()->getQuery()->toArray();
        $repository = $this->entityManager()->getRepository(Board::class);
        $query = $repository->getQueryBuilder()->addOrderBy('board.id' , 'DESC')->getQuery();

        $result = $this->tableData()->getAjaxData($query, $params, 'board');
        $json = new JsonModel($result);
        return $json;
    }
}