<?php

namespace Yu\User\Controller\Admin;

use Laminas\View\Model\ViewModel;
use Laminas\Crypt\Password\Bcrypt;
use Yu\Admin\Controller\AbstractAdminController;
use Yu\User\Entity\User as EntityUser;

class ProfileController extends AbstractAdminController
{
    /**
     * @var \Yu\Admin\Service\Form\FormManager
     */
    private $formManager;

    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $entityManager;

    /**
     * ProfileController constructor.
     * @param \Yu\Admin\Service\Form\FormManager $formManager
     * @param \Doctrine\ORM\EntityManagerInterface $entityManager
     */
    public function __construct(
        \Yu\Admin\Service\Form\FormManager $formManager,
        \Doctrine\ORM\EntityManagerInterface $entityManager
    )
    {
        $this->formManager = $formManager;
        $this->entityManager = $entityManager;
    }

    public function indexAction()
    {
        $form = $this->formManager->getForm('profile');
        $user = $this->entityManager->getRepository(EntityUser::class)->getUserById($this->authAdmin()->getIdentity());
        $form->setDataToFieldset('user', $user);

        $view = new ViewModel();
        $view->setTemplate('admin/form');
        $view->setVariable('form', $form);
        $view->setVariable('h1', 'Ваши данные');
        return $view;
    }

    public function saveAction()
    {
        if($this->getRequest()->isPost()) {
            $form = $this->formManager->getForm('profile');
            $user = $this->entityManager->getRepository(EntityUser::class)->getUserById($this->authAdmin()->getIdentity());
            $dataPost = $this->params()->fromPost();
            $form->setData($dataPost);
            if($form->isValid()) {
                $data = $form->getData();
                $user->setName($data['user']['name']);
                $user->setEmail($data['user']['email']);
                if(!empty($data['user']['password']) && $data['user']['name'] !== "") {
                    $bcrypt = new Bcrypt();
                    $passwordHash = $bcrypt->create($data['user']['name']);
                    $user->setPassword($passwordHash);
                }
                $this->entityManager->persist($user);
                $this->entityManager->flush();
                $this->flashMessenger()->addSuccessMessage('Данные сохранены');
            }
        }
        return $this->redirect()->toRoute('admin/profile');
    }
}