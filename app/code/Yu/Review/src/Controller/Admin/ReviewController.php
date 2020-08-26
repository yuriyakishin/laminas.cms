<?php

namespace Yu\Review\Controller\Admin;

use Yu\Admin\Controller\AbstractAdminController;
use Laminas\View\Model\ViewModel;
use Yu\Review\Entity\Review;

class ReviewController extends AbstractAdminController
{
    public function indexAction()
    {
        $entities = $this->entityManager()->getRepository(Review::class)->findAll();

        $table = $this->tableManager()->createTable('review');
        $table->setOptions(['route' => 'admin/review']);

        $this->layout()->setVariable('h1','Отзывы');
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
        $form = $this->formManager()->getForm('review');
        $review = $this->entityManager()->getRepository(Review::class)->findOneById($id);

        $this->formManager()->setDataToFieldset($form,'review',$review);

        if(empty($id)) {
            $this->layout()->setVariable('h1', 'Добавить отзыв');
        } else {
            $this->layout()->setVariable('h1', 'Редактировать отзыв');
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
            $form = $this->formManager()->getForm('review');

            $form->setData($data);

            if ($form->isValid()) {
                try {
                    $id = (int)$data['review']['id'] ?? 0;

                    $reviewRepository = $this->entityManager()->getRepository(Review::class);

                    $review = $reviewRepository->findOneById($id);
                    if(empty($review)) {
                        $review = new Review();
                    }
                    $this->formManager()->importDataToEntity($form, 'review', $review);
                    $review->setSiteId($this->authAdmin()->getCurrentUser()->getSiteId());
                    $review->setPath('review');
                    $review->setPathId(1);
                    $id = $reviewRepository->save($review);

                    // Сохранение фотогалереи Images
                    if (isset($data['images'])) {
                        $this->entityManager()->getRepository(\Yu\Media\Entity\Image::class)->saveGallery($data['images'],
                            [
                                'user_id' => $this->authAdmin()->getCurrentUser()->getId(),
                                'site_id' => $this->authAdmin()->getCurrentUser()->getSiteId(),
                                'path' => 'review',
                                'path_id' => $id,
                            ]);
                    }

                    $this->flashMessenger()->addSuccessMessage("Данные сохранены");
                    if (empty($data['save_end_close'])) {
                        return $this->redirect()->toRoute('admin/review/edit', ['id' => $id]);
                    }
                } catch (\Exception $e) {
                    $this->flashMessenger()->addErrorMessage("Ошибка записи в базу данных: " . $e->getMessage());
                    return $this->redirect()->toRoute('admin/review/edit', $form->getData());
                }
            }
        }
        return $this->redirect()->toRoute('admin/review');
    }

    public function deleteAction()
    {
        $id = $this->getRequest()->getQuery('id');
        if(!empty($id))
        {
            $entity = $this->entityManager()->getRepository(Review::class)->findOneById($id);
            $this->entityManager()->getRepository(Review::class)->remove($entity);
        }
        $this->layout()->setTerminal(true);

        return $this->getResponse();
    }
}