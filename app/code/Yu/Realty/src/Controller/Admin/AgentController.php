<?php

namespace Yu\Realty\Controller\Admin;

use Yu\Admin\Controller\AbstractAdminController;
use Laminas\View\Model\ViewModel;
use Yu\Realty\Entity\Agent;

class AgentController extends AbstractAdminController
{
    public function indexAction()
    {
        $entities = $this->entityManager()->getRepository(Agent::class)->findAll();

        $table = $this->tableManager()->createTable('agent');
        $table->setOptions(['route' => 'admin/agent']);

        $this->layout()->setVariable('h1','Агенты');
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
        $form = $this->formManager()->getForm('agent');
        $agent = $this->entityManager()->getRepository(Agent::class)->findOneById($id);

        $this->formManager()->setDataToFieldset($form,'agent',$agent);

        if(empty($id)) {
            $this->layout()->setVariable('h1', 'Добавить агента');
        } else {
            $this->layout()->setVariable('h1', 'Редактировать агента');
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
            $form = $this->formManager()->getForm('agent');

            $form->setData($data);

            if ($form->isValid()) {
                try {
                    $id = (int)$data['agent']['id'] ?? 0;

                    $agentRepository = $this->entityManager()->getRepository(Agent::class);

                    $agent = $agentRepository->findOneById($id);
                    if(empty($agent)) {
                        $agent = new Agent();
                    }
                    $this->formManager()->importDataToEntity($form, 'agent', $agent);
                    $agent->setSiteId($this->authAdmin()->getCurrentUser()->getSiteId());
                    $id = $agentRepository->save($agent);

                    if (isset($data['images'])) {
                        $this->entityManager()->getRepository(\Yu\Media\Entity\Image::class)->saveGallery($data['images'],
                            [
                                'user_id' => $this->authAdmin()->getCurrentUser()->getId(),
                                'site_id' => $this->authAdmin()->getCurrentUser()->getSiteId(),
                                'path' => 'agent',
                                'path_id' => $id,
                            ]);
                    }

                    $this->flashMessenger()->addSuccessMessage("Данные сохранены");
                    if (empty($data['save_end_close'])) {
                        return $this->redirect()->toRoute('admin/agent/edit', ['id' => $id]);
                    }
                } catch (\Exception $e) {
                    $this->flashMessenger()->addErrorMessage("Ошибка записи в базу данных: " . $e->getMessage());
                    return $this->redirect()->toRoute('admin/agent/edit', $form->getData());
                }
            }
        }
        return $this->redirect()->toRoute('admin/agent');
    }

    public function deleteAction()
    {
        $id = $this->getRequest()->getQuery('id');
        if(!empty($id))
        {
            $entity = $this->entityManager()->getRepository(Agent::class)->findOneById($id);
            $this->entityManager()->getRepository(Agent::class)->remove($entity);
        }
        $this->layout()->setTerminal(true);

        return $this->getResponse();
    }
}