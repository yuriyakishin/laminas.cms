<?php

namespace Yu\Blog\Controller\Admin;

use Yu\Admin\Controller\AbstractAdminController;
use Laminas\View\Model\ViewModel;
use Yu\Blog\Entity\Post;
use Yu\Seo\Entity\Meta;

class PostController extends AbstractAdminController
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
        $entities = $this->entityManager()->getRepository(Post::class)->findAll();
        //echo $pages; die;
        $table = $this->tableManager->createTable('blog-post');
        $table->setOptions(['route' => 'admin/post']);

        $this->layout()->setVariable('h1','Записи');
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
        $form = $this->formManager->getForm('blog-post');

        $post = $this->entityManager()->getRepository(Post::class)->findOneById($id);
        $meta = $this->entityManager()->getRepository(Meta::class)->findMeta('post', $id);

        $this->formManager->setDataToFieldset($form,'post',$post);
        $this->formManager->setDataToFieldset($form,'meta',$meta);

        if(empty($id)) {
            $this->layout()->setVariable('h1', 'Создание записи');
        } else {
            $this->layout()->setVariable('h1', 'Редактирование записи');
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
            $form = $this->formManager->getForm('blog-post');

            $form->setData($data);

            if ($form->isValid()) {
                try {
                    $id = (int)$data['post']['id'] ?? 0;

                    $postRepository = $this->entityManager()->getRepository(Post::class);
                    /** @var \Yu\Content\Entity\Page $page */
                    $post = $postRepository->findOneById($id);
                    if(empty($post)) {
                        $post = new Post();
                    }
                    $this->formManager->importDataToEntity($form, 'post', $post);
                    $post->setUserId($this->authAdmin()->getCurrentUser()->getId());
                    $post->setSiteId($this->authAdmin()->getCurrentUser()->getSiteId());
                    $id = $postRepository->save($post);

                    $meta = $this->entityManager()->getRepository(Meta::class)->findMeta('post', $id);
                    $meta->setEntityId($id);
                    $meta->setPath('post');
                    $this->formManager->importDataToEntity($form, 'meta', $meta);
                    $this->entityManager()->getRepository(Meta::class)->save($meta);

                    if (isset($data['images'])) {
                        $this->entityManager()->getRepository(\Yu\Media\Entity\Image::class)->saveGallery($data['images'],
                            [
                                'user_id' => $this->authAdmin()->getCurrentUser()->getId(),
                                'site_id' => $this->authAdmin()->getCurrentUser()->getSiteId(),
                                'path' => 'post',
                                'path_id' => $id,
                            ]);
                    }

                    $this->flashMessenger()->addSuccessMessage("Данные сохранены");
                    if (empty($data['save_end_close'])) {
                        return $this->redirect()->toRoute('admin/post/edit', ['id' => $id]);
                    }
                } catch (\Exception $e) {
                    $this->flashMessenger()->addErrorMessage("Ошибка записи в базу данных: " . $e->getMessage());
                    return $this->redirect()->toRoute('admin/post/edit', $form->getData());
                }
            }
        }
        return $this->redirect()->toRoute('admin/post');
    }

    public function deleteAction()
    {
        $id = $this->getRequest()->getQuery('id');
        if(!empty($id))
        {
            $entity = $this->entityManager()->getRepository(Post::class)->findOneById($id);
            $this->entityManager()->getRepository(Post::class)->remove($entity);

            $meta = $this->entityManager()->getRepository(Meta::class)->findMeta('post', $id);
            $this->entityManager()->getRepository(Meta::class)->remove($meta);
        }
        $this->layout()->setTerminal(true);

        return $this->getResponse();
    }
}