<?php

namespace Yu\Realty\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Yu\Content\Entity\Page;
use Yu\Realty\Entity\Agent;
use Yu\Seo\Model\Meta;

class AgentController extends AbstractActionController
{
    public function searchAction()
    {
        $error = '';
        $code = '';
        if ($this->getRequest()->isPost()) {
            $code = $this->getRequest()->getPost('code');
            $agent = $this->entityManager()->getRepository(Agent::class)->findOneByCode($code);
            if (!empty($agent)) {
                $this->redirect()->toRoute('agent-search/page', ['code' => $code]);
            } else {
                $error = 'Специалист не найден';
            }
        }

        $page = $this->entityManager()->getRepository(Page::class)->findOneByIdentifier('agent-search');
        if ($page == null) {
            $page = new Page();
        }

        $view = new ViewModel(['page' => $page, 'code' => $code, 'error' => $error, 'path' => 'page', 'entityId' => $page->getId()]);
        $view->setTemplate('agent/search');
        return $view;
    }

    public function pageAction()
    {
        $code = $this->params('code');
        $agent = $this->entityManager()->getRepository(Agent::class)->findOneByCode($code);

        $meta = Meta::getInstance();
        $meta->setTitle($agent->getName());

        $view = new ViewModel(['agent' => $agent]);
        $view->setTemplate('agent/page');
        return $view;
    }

}