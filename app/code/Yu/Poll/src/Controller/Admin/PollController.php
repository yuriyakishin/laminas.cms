<?php

namespace Yu\Poll\Controller\Admin;

use Yu\Admin\Controller\AbstractAdminController;
use Laminas\View\Model\ViewModel;
use Yu\Poll\Entity;

class PollController extends AbstractAdminController
{
    public function indexAction()
    {
        $entities = $this->entityManager()->getRepository(Entity\PollTheme::class)->findAll();

        $table = $this->tableManager()->createTable('poll');
        $table->setOptions(['route' => 'admin/poll']);

        $this->layout()->setVariable('h1', 'Опросы');
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
        $form = $this->formManager()->getForm('poll');
        $poll = $this->entityManager()->getRepository(Entity\PollTheme::class)->findOneById($id);

        $this->formManager()->setDataToFieldset($form, 'poll', $poll);

        // варианты ответов
        $optionRepository = $this->entityManager()->getRepository(Entity\PollOption::class);
        $options = [];
        for ($j = 1; $j <= 10; $j++) {
            $option = $optionRepository->findOneBy(['themeId' => $id, 'sort' => $j]);
            if(empty($option)) {
                $options['option_'.$j] = '';
            } else {
                $options['option_'.$j] = $option->getValue();
            }
        }
        $this->formManager()->setDataToFieldset($form, 'options', $options);


        if (empty($id)) {
            $this->layout()->setVariable('h1', 'Добавить опрос');
        } else {
            $this->layout()->setVariable('h1', 'Редактировать опрос');
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
            $form = $this->formManager()->getForm('poll');

            $form->setData($data);

            if ($form->isValid()) {
                try {
                    $id = (int)$data['poll']['id'] ?? 0;

                    $pollRepository = $this->entityManager()->getRepository(Entity\PollTheme::class);

                    $poll = $pollRepository->findOneById($id);
                    if (empty($poll)) {
                        $poll = new Entity\PollTheme();
                    }
                    $this->formManager()->importDataToEntity($form, 'poll', $poll);
                    $poll->setSiteId($this->authAdmin()->getCurrentUser()->getSiteId());
                    $poll->setUserId($this->authAdmin()->getCurrentUser()->getId());
                    $id = $pollRepository->save($poll);

                    // Сохранение ответов
                    $optionRepository = $this->entityManager()->getRepository(Entity\PollOption::class);
                    $i = 1;
                    for ($j = 1; $j <= 10; $j++) {
                        /** @var Entity\PollOption $option */
                        $option = $optionRepository->findOneBy(['themeId' => $id, 'sort' => $j]);
                        $value = $data['options']['option_' . $j];
                        if (empty($option)) {
                            if (!empty($value)) {
                                $optionNew = new Entity\PollOption();
                                $optionNew->setThemeId($id);
                                $optionNew->setSort($j);
                                $optionNew->setValue($value);
                                $optionNew->setResult(0);
                                $optionId = $optionRepository->save($optionNew);
                            }
                        } else {
                            if (!empty($value)) {
                                $option->setValue($value);
                                $optionRepository->save($option);
                            } else {
                                $optionRepository->remove($option);
                            }
                        }
                    }

                    $this->flashMessenger()->addSuccessMessage("Данные сохранены");
                    if (empty($data['save_end_close'])) {
                        return $this->redirect()->toRoute('admin/poll/edit', ['id' => $id]);
                    }
                } catch (\Exception $e) {
                    $this->flashMessenger()->addErrorMessage("Ошибка записи в базу данных: " . $e->getMessage());
                    return $this->redirect()->toRoute('admin/poll/edit', $form->getData());
                }
            }
        }
        return $this->redirect()->toRoute('admin/poll');
    }

    public function deleteAction()
    {
        $id = $this->getRequest()->getQuery('id');
        if(!empty($id))
        {
            $entity = $this->entityManager()->getRepository(Entity\PollTheme::class)->findOneById($id);
            $this->entityManager()->getRepository(Entity\PollTheme::class)->remove($entity);
        }
        $this->layout()->setTerminal(true);

        return $this->getResponse();
    }
}