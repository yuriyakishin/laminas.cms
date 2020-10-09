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
        if($page == null) {
            $page = new PageEntity();
        }

        $view = new ViewModel([
            'page' => $page,
            'path' => 'page',
            'entityId' => $page->getId()]);

        $config = $this->config()->get();
        if (isset($config['view_manager']['template_map']['yu/page/' . $identifier])) {
            $view->setTemplate('yu/page/' . $identifier);
        } else {
            $view->setTemplate('yu/page');
        }
        return $view;
    }
}