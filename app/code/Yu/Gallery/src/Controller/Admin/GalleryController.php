<?php

namespace Yu\Gallery\Controller\Admin;

use Yu\Admin\Controller\AbstractAdminController;
use Laminas\View\Model\ViewModel;
use Yu\Gallery\Entity\Gallery;
use Yu\Seo\Entity\Meta;

class GalleryController extends AbstractAdminController
{
    /**
     * @var \Yu\Admin\Service\TableManager
     */
    private $tableManager;

    /**
     * @var \Yu\Admin\Service\Form\FormManager
     */
    private $formManager;


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
        $galleries = $this->entityManager()->getRepository(Gallery::class)->findAll();

        $table = $this->tableManager->createTable('gallery');
        $table->setOptions(['route' => 'admin/gallery']);

        $this->layout()->setVariable('h1', 'Галереи');
        $view = new ViewModel();
        $view->setTemplate('admin/table');
        $view->setVariable('table', $table);
        $view->setVariable('rowsData', $galleries);
        return $view;
    }

    public function editAction()
    {
        $id = $this->params('id', 0);
        /** @var \Yu\Admin\Service\Form\FormModel $form */
        $form = $this->formManager->getForm('gallery');
        $gallery = $this->entityManager()->getRepository(Gallery::class)->findOneById($id);
        $meta = $this->entityManager()->getRepository(Meta::class)->findMeta('gallery', $id);

        $this->formManager->setDataToFieldset($form, 'gallery', $gallery);
        $this->formManager->setDataToFieldset($form, 'meta', $meta);

        if (empty($id)) {
            $this->layout()->setVariable('h1', 'Создание галереи');
        } else {
            $this->layout()->setVariable('h1', 'Редактирование галереи');
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
            $form = $this->formManager->getForm('gallery');

            $form->setData($data);

            if ($form->isValid()) {
                try {
                    $id = (int)$data['gallery']['id'] ?? 0;

                    $galleryRepository = $this->entityManager()->getRepository(Gallery::class);
                    /** @var \Yu\Gallery\Entity\Gallery $gallery */
                    $gallery = $galleryRepository->findOneById($id);
                    if(empty($gallery)) {
                        $gallery = new Gallery();
                    }
                    $this->formManager->importDataToEntity($form, 'gallery', $gallery);
                    $gallery->setUserId($this->authAdmin()->getCurrentUser()->getId());
                    $gallery->setSiteId($this->authAdmin()->getCurrentUser()->getSiteId());
                    $id = $galleryRepository->save($gallery);

                    $meta = $this->entityManager()->getRepository(Meta::class)->findMeta('gallery', $id);
                    $meta->setEntityId($id);
                    $meta->setPath('gallery');
                    $this->formManager->importDataToEntity($form, 'meta', $meta);
                    $this->entityManager()->getRepository(Meta::class)->save($meta);

                    if (isset($data['images'])) {
                        $this->entityManager()->getRepository(\Yu\Media\Entity\Image::class)->saveGallery($data['images'],
                            [
                                'user_id' => $this->authAdmin()->getCurrentUser()->getId(),
                                'site_id' => $this->authAdmin()->getCurrentUser()->getSiteId(),
                                'path' => 'gallery',
                                'path_id' => $id,
                            ]);
                    }


                    $this->flashMessenger()->addSuccessMessage("Данные сохранены");
                    if (empty($data['save_end_close'])) {
                        return $this->redirect()->toRoute('admin/gallery/edit', ['id' => $id]);
                    }
                } catch (\Exception $e) {
                    $this->flashMessenger()->addErrorMessage("Ошибка записи в базу данных: " . $e->getMessage());
                    return $this->redirect()->toRoute('admin/gallery/edit', $form->getData());
                }
            }
        }

        return $this->redirect()->toRoute('admin/gallery');
    }

    public function deleteAction()
    {
        $id = $this->getRequest()->getQuery('id');
        if (!empty($id)) {
            $gallery = $this->entityManager()->getRepository(Gallery::class)->findOneById($id);
            $this->entityManager()->getRepository(Gallery::class)->remove($gallery);

            $meta = $this->entityManager()->getRepository(Meta::class)->findMeta('gallery', $id);
            $this->entityManager()->getRepository(Meta::class)->remove($meta);
        }
        $this->layout()->setTerminal(true);

        return $this->getResponse();
    }
}