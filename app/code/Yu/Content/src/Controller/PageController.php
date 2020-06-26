<?php

namespace Yu\Content\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Yu\Content\Entity\Page as PageEntity;

class PageController extends AbstractActionController
{
    public function indexAction()
    {
        $identifier = $this->params('identifier');

        $repository = $this->entityManager()->getRepository(PageEntity::class);

        $page = $repository->findOneByIdentifier($identifier);

        $view = new ViewModel(['page' => $page,
            'metaKeys' => [
                'path' => 'page',
                'entityId' => $page->getId()
            ]]);
        $view->setTemplate('yu/page');
        return $view;
    }
}