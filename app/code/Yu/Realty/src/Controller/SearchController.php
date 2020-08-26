<?php

namespace Yu\Realty\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Yu\Realty\Entity\Realty;

class SearchController extends AbstractActionController
{

    public function searchByCodeAction()
    {
        $code = $this->getRequest()->getQuery('code');
        if (!empty($code)) {
            $repository = $this->entityManager()->getRepository(Realty::class);
            $realty = $repository->findOneByCode($code);
            if ($realty != null) {
                $route = $realty->getType() . '/' . $realty->getId();
                $this->redirect()->toRoute($realty->getType() . '/view', ['id' => $realty->getId()]);
            }
        }

        $view = new ViewModel();
        $view->setTemplate('realty/not-found');
        return $view;
    }
}