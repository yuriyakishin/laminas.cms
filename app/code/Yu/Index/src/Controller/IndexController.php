<?php

declare(strict_types=1);

namespace Yu\Index\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $repository = $this->entityManager()->getRepository(\Yu\Content\Entity\Page::class);
        $page = $repository->findOneByIdentifier('home');

        $this->layout()->setVariable('isHome', true);

        $view = new ViewModel(['page' => $page,
            'metaKeys' => [
                'path' => 'page',
                'entityId' => $page->getId()
            ]]);
        $view->setTemplate('yu/index');
        return $view;
    }
}
