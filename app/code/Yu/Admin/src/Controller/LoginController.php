<?php

namespace Yu\Admin\Controller;

use Laminas\View\Model\ViewModel;

class LoginController extends \Laminas\Mvc\Controller\AbstractActionController
{
    public function indexAction()
    {

        if(!empty($this->authAdmin()->getIdentity())) {
            $this->redirect()->toRoute('admin');
        }

        $this->layout('admin/layout/login');
        $view = new ViewModel();
        $view->setTemplate('admin/login/index');
        return $view;
    }

    public function enterAction()
    {
        if(!empty($this->authAdmin()->getIdentity())) {
            $this->redirect()->toRoute('admin');
        }

        $email = $this->params()->fromPost('email');
        $password = $this->params()->fromPost('password');
        $remember = ($this->params()->fromPost('remember') === 1) ? true : false;

        if($this->authAdmin()->login($email,$password,$remember) === true) {
            return $this->redirect()->toRoute('admin');
        }

        $this->flashMessenger()->addErrorMessage('Неверный логин или пароль');

        return $this->redirect()->toRoute('admin/login');
    }

    public function exitAction()
    {
        $this->authAdmin()->logout();
        return $this->redirect()->toRoute('admin');
    }
}