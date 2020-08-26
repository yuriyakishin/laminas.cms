<?php

namespace Yu\Catalog\Controller\Admin;

use Laminas\View\Model\ViewModel;
use Yu\Admin\Controller\AbstractAdminController;
use Yu\Catalog\Entity\Catalog;
use Yu\Eav\Entity\EavValueInt;
use Yu\Eav\Entity\EavValueText;

class CatalogController extends AbstractAdminController
{
    public function indexAction()
    {
        $entities = $this->entityManager()->getRepository(Catalog::class)->findCatalog();
        //echo $pages; die;
        $table = $this->tableManager()->createTable('catalog');
        $table->setOptions(['route' => 'admin/catalog']);

        $this->layout()->setVariable('h1', 'Объявления Купим/Снимем');
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
        $form = $this->formManager()->getForm('catalog');

        $entity = $this->entityManager()->getRepository(Catalog::class)->findOneById($id);

        $this->formManager()->setDataToFieldset($form, 'catalog', $entity);

        if(!empty($entity)) {
            $attributes = $this->eav()->getEntityAttributes('catalog', $entity->getId());
            $this->formManager()->setDataToFieldset($form, 'catalog', $attributes);
        }

        if (empty($id)) {
            $this->layout()->setVariable('h1', 'Объявления Купим/Снимем - Добавить');
        } else {
            $this->layout()->setVariable('h1', 'Объявления Купим/Снимем - Редактировать');
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
            $form = $this->formManager()->getForm('catalog');

            $form->setData($data);

            if ($form->isValid()) {
                try {
                    $id = (int)$data['catalog']['id'] ?? 0;

                    $repository = $this->entityManager()->getRepository(Catalog::class);

                    /** @var \Yu\Catalog\Entity\Catalog $entity */
                    $entity = $repository->findOneById($id);
                    if (empty($entity)) {
                        $entity = new Catalog();
                    }
                    $this->formManager()->importDataToEntity($form, 'catalog', $entity);
                    $entity->setUserId($this->authAdmin()->getCurrentUser()->getId());
                    $entity->setSiteId($this->authAdmin()->getCurrentUser()->getSiteId());

                    $id = $repository->save($entity);

                    //
                    //var_dump($data['catalog']['category_id']);die;
                    $repositoryValueInt = $this->entityManager()->getRepository(EavValueInt::class);
                    $repositoryValueInt->save(901, $id, $data['catalog']['category_id']);

                    //var_dump($data['catalog']['category_id']);die;
                    $repositoryValueText = $this->entityManager()->getRepository(EavValueText::class);
                    $repositoryValueText->save(902, $id, $data['catalog']['phone']);
                    $repositoryValueText->save(903, $id, $data['catalog']['email']);

                    $this->flashMessenger()->addSuccessMessage("Данные сохранены");
                    if (empty($data['save_end_close'])) {
                        return $this->redirect()->toRoute('admin/catalog/edit', ['id' => $id]);
                    }
                } catch (\Doctrine\ORM\ORMException $e) {
                    $this->flashMessenger()->addErrorMessage("Ошибка записи в базу данных: " . $e->getMessage());
                    return $this->redirect()->toRoute('admin/catalog/edit', $form->getData());
                }
            }
        }
        return $this->redirect()->toRoute('admin/catalog');
    }

}