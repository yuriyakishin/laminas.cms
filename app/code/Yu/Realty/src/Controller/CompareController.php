<?php

namespace Yu\Realty\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class CompareController extends AbstractActionController
{

    public function indexAction()
    {
        $view = new ViewModel();
        $view->setTemplate('realty/compare');
        return $view;
    }

    public function ajaxAction()
    {
        $idsStr = $this->getRequest()->getQuery('ids');
        $ids = explode(',',$idsStr);

        $view = new ViewModel(['ids' => $ids]);
        $view->setTerminal(true);
        $view->setTemplate('realty/compare/ajax');
        return $view;
    }
}