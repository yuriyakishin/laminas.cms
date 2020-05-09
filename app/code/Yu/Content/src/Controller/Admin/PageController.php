<?php

namespace Yu\Content\Controller\Admin;

use Yu\Admin\Controller\AbstractAdminController;
use Laminas\View\Model\ViewModel;
use Yu\Content\Entity\Page;
use Yu\Seo\Entity\Meta;

class PageController extends AbstractAdminController
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
        $pages = $this->entityManager()->getRepository(Page::class)->findAllPages();
        //echo $pages; die;
        $table = $this->tableManager->createTable('pages');
        $table->setOptions(['route' => 'admin/page']);

        $this->layout()->setVariable('h1', 'Страницы');
        $view = new ViewModel();
        $view->setTemplate('admin/table');
        $view->setVariable('table', $table);
        $view->setVariable('rowsData', $pages);
        return $view;
    }

    public function editAction()
    {
        $id = $this->params('id', 0);
        /** @var \Yu\Admin\Service\Form\FormModel $form */
        $form = $this->formManager->getForm('page');
        $page = $this->entityManager()->getRepository(Page::class)->findPageById($id);
        $meta = $this->entityManager()->getRepository(Meta::class)->findMeta('page', $id);

        $this->formManager->setDataToFieldset($form, 'page', $page);
        $this->formManager->setDataToFieldset($form, 'meta', $meta);

        if (empty($id)) {
            $this->layout()->setVariable('h1', 'Создание страницы');
        } else {
            $this->layout()->setVariable('h1', 'Редактирование страницы');
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
            $form = $this->formManager->getForm('page');

            //$form->setDataToFieldset('page', $data['page']);
            //$form->setDataToFieldset('meta', $data['meta']);

            $form->setData($data);

            if ($form->isValid()) {
                try {
                    $id = (int)$data['page']['id'] ?? 0;

                    $pageRepository = $this->entityManager()->getRepository(Page::class);
                    /** @var \Yu\Content\Entity\Page $page */
                    $page = $pageRepository->findPageById($id);
                    $this->formManager->importDataToEntity($form, 'page', $page);
                    $page->setUserId($this->authAdmin()->getCurrentUser()->getId());
                    $page->setSiteId($this->authAdmin()->getCurrentUser()->getSiteId());
                    $id = $pageRepository->save($page);

                    $meta = $this->entityManager()->getRepository(Meta::class)->findMeta('page', $id);
                    $meta->setEntityId($id);
                    $meta->setPath('page');
                    $this->formManager->importDataToEntity($form, 'meta', $meta);
                    $this->entityManager()->getRepository(Meta::class)->save($meta);

                    if (isset($data['images'])) {
                        $this->entityManager()->getRepository(\Yu\Media\Entity\Image::class)->saveGallery($data['images'],
                            [
                                'user_id' => $this->authAdmin()->getCurrentUser()->getId(),
                                'site_id' => $this->authAdmin()->getCurrentUser()->getSiteId(),
                                'path' => 'page',
                                'path_id' => $id,
                            ]);
                    }


                    $this->flashMessenger()->addSuccessMessage("Данные сохранены");
                    if (empty($data['save_end_close'])) {
                        return $this->redirect()->toRoute('admin/page/edit', ['id' => $id]);
                    }
                } catch (\Exception $e) {
                    $this->flashMessenger()->addErrorMessage("Ошибка записи в базу данных: " . $e->getMessage());
                    return $this->redirect()->toRoute('admin/page/edit', $form->getData());
                }
            }
        }

        return $this->redirect()->toRoute('admin/page');
    }

    public function deleteAction()
    {
        $id = $this->getRequest()->getQuery('id');
        if (!empty($id)) {
            $page = $this->entityManager()->getRepository(Page::class)->findPageById($id);
            $this->entityManager()->getRepository(Page::class)->remove($page);

            $meta = $this->entityManager()->getRepository(Meta::class)->findMeta('page', $id);
            $this->entityManager()->getRepository(Meta::class)->remove($meta);
        }
        $this->layout()->setTerminal(true);

        return $this->getResponse();
    }
}