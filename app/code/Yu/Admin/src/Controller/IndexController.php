<?php

namespace Yu\Admin\Controller;

use Laminas\View\Model\ViewModel;

class IndexController extends AbstractAdminController
{
    public function indexAction()
    {
        $this->layout()->setVariable('h1' , 'Панель управления сайтом АН Масштаб');
        $view = new ViewModel();
        $view->setTemplate('admin/index');
        return $view;
    }
}