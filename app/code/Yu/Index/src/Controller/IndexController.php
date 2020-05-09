<?php

declare(strict_types=1);

namespace Yu\Index\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $this->getResponse()->setContent('Some content');
        return new ViewModel();
    }
}
