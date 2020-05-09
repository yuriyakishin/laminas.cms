<?php

namespace Yu\Admin\Controller;

use Laminas\View\Model\ViewModel;

class IndexController extends AbstractAdminController
{
    public function indexAction()
    {
        $view = new ViewModel();
        $view->setTemplate('admin/index');
        return $view;
    }
}