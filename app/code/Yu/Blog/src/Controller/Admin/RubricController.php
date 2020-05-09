<?php

namespace Yu\Blog\Controller\Admin;

use Yu\Admin\Controller\AbstractAdminController;
use Laminas\View\Model\ViewModel;
use Yu\Blog\Entity\Rubric;
use Yu\Seo\Entity\Meta;

class RubricController extends AbstractAdminController
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
        $rubrics = $this->entityManager()->getRepository(Rubric::class)->findAll();
        //echo $pages; die;
        $table = $this->tableManager->createTable('blog-rubric');
        $table->setOptions(['route' => 'admin/blog']);

        $this->layout()->setVariable('h1','Рубрики публикаций');
        $view = new ViewModel();
        $view->setTemplate('admin/table');
        $view->setVariable('table',$table);
        $view->setVariable('rowsData',$rubrics);
        return $view;
    }

    public function editAction()
    {
        $id = $this->params('id',0);
        /** @var \Yu\Admin\Service\Form\FormModel $form */
        $form = $this->formManager->getForm('blog-rubric');
        $rubric = $this->entityManager()->getRepository(Rubric::class)->findOneById($id);
        $meta = $this->entityManager()->getRepository(Meta::class)->findMeta('rubric', $id);

        $this->formManager->setDataToFieldset($form,'rubric',$rubric);
        $this->formManager->setDataToFieldset($form,'meta',$meta);

        if(empty($id)) {
            $this->layout()->setVariable('h1', 'Создание рубрики');
        } else {
            $this->layout()->setVariable('h1', 'Редактирование рубрики');
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
            $form = $this->formManager->getForm('blog-rubric');

            $form->setData($data);

            if ($form->isValid()) {
                try {
                    $id = (int)$data['rubric']['id'] ?? 0;

                    $rubricRepository = $this->entityManager()->getRepository(Rubric::class);

                    $rubric = $rubricRepository->findRubricById($id);
                    $this->formManager->importDataToEntity($form, 'rubric', $rubric);
                    $rubric->setUserId($this->authAdmin()->getCurrentUser()->getId());
                    $rubric->setSiteId($this->authAdmin()->getCurrentUser()->getSiteId());
                    $id = $rubricRepository->save($rubric);

                    $meta = $this->entityManager()->getRepository(Meta::class)->findMeta('rubric', $id);
                    $meta->setEntityId($id);
                    $meta->setPath('rubric');
                    $this->formManager->importDataToEntity($form, 'meta', $meta);
                    $this->entityManager()->getRepository(Meta::class)->save($meta);

                    $this->flashMessenger()->addSuccessMessage("Данные сохранены");
                    if (empty($data['save_end_close'])) {
                        return $this->redirect()->toRoute('admin/blog/edit', ['id' => $id]);
                    }
                } catch (\Exception $e) {
                    //var_dump($form->getData());die;
                    $this->flashMessenger()->addErrorMessage("Ошибка записи в базу данных: " . $e->getMessage());
                    return $this->redirect()->toRoute('admin/blog/edit', $form->getData());
                }
            }
        }
        return $this->redirect()->toRoute('admin/blog');
    }

    public function deleteAction()
    {
        $id = $this->getRequest()->getQuery('id');
        if(!empty($id))
        {
            $entity = $this->entityManager()->getRepository(Rubric::class)->findOneById($id);
            $this->entityManager()->getRepository(Rubric::class)->remove($entity);

            $meta = $this->entityManager()->getRepository(Meta::class)->findMeta('rubric', $id);
            $this->entityManager()->getRepository(Meta::class)->remove($meta);
        }
        $this->layout()->setTerminal(true);

        return $this->getResponse();
    }
}