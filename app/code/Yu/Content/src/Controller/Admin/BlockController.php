<?php

namespace Yu\Content\Controller\Admin;

use Yu\Admin\Controller\AbstractAdminController;
use Laminas\View\Model\ViewModel;
use Yu\Content\Entity\Block;


class BlockController extends AbstractAdminController
{
    /**
     * @var \Yu\Admin\Service\TableManager
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
        $blocks = $this->entityManager()->getRepository(Block::class)->findAllBlocks();
        //echo $pages; die;
        $table = $this->tableManager->createTable('blocks');
        $table->setOptions(['route' => 'admin/block']);

        $this->layout()->setVariable('h1','Блоки');
        $view = new ViewModel();
        $view->setTemplate('admin/table');
        $view->setVariable('table',$table);
        $view->setVariable('rowsData',$blocks);
        return $view;
    }

    public function editAction()
    {
        $id = $this->params('id',0);
        /** @var \Yu\Admin\Service\Form\FormModel $form */
        $form = $this->formManager->getForm('block');
        $block = $this->entityManager()->getRepository(Block::class)->findBlockById($id);

        $this->formManager->setDataToFieldset($form,'block',$block);

        if(empty($id)) {
            $this->layout()->setVariable('h1', 'Создание блока');
        } else {
            $this->layout()->setVariable('h1', 'Редактирование блока');
        }
        $view = new ViewModel();
        $view->setTemplate('admin/form');
        $view->setVariable('form', $form);
        return $view;
    }

    public function saveAction()
    {
        if($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            /** @var \Yu\Admin\Service\Form\FormModel $form */
            $form = $this->formManager->getForm('block');

            $form->setData($data);

            if($form->isValid()) {
                try {
                    $id = (int)$data['block']['id'] ?? 0;

                    $blockRepository = $this->entityManager()->getRepository(Block::class);
                    /** @var \Yu\Content\Entity\Block $block */
                    $block = $blockRepository->findBlockById($id);
                    $this->formManager->importDataToEntity($form, 'block', $block);
                    $block->setUserId($this->authAdmin()->getCurrentUser()->getId());
                    $block->setSiteId($this->authAdmin()->getCurrentUser()->getSiteId());
                    $id = $blockRepository->save($block);

                    $this->flashMessenger()->addSuccessMessage("Данные сохранены");
                    if(empty($data['save_end_close'])) {
                        return $this->redirect()->toRoute('admin/block/edit', ['id' => $id]);
                    }
                } catch (\Exception $e) {
                    $this->flashMessenger()->addErrorMessage("Ошибка записи в базу данных: ".$e->getMessage());
                    return $this->redirect()->toRoute('admin/block/edit', $form->getData());
                }
            }
        }

        return $this->redirect()->toRoute('admin/block');
    }

    public function deleteAction()
    {
        $id = $this->getRequest()->getQuery('id');
        if(!empty($id))
        {
            $block = $this->entityManager()->getRepository(Block::class)->findBlockById($id);
            $this->entityManager()->getRepository(Block::class)->remove($block);
        }
        $this->layout()->setTerminal(true);

        return $this->getResponse();
    }
}