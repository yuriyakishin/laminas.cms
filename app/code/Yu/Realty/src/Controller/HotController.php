<?php

namespace Yu\Realty\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Yu\Realty\Entity\Realty;

class HotController extends AbstractActionController
{
    /**
     * @var \Yu\Realty\Service\RealtyManager
     */
    private $realtyManager;

    /**
     * HotController constructor.
     * @param \Yu\Realty\Service\RealtyManager $realtyManager
     */
    public function __construct(
        \Yu\Realty\Service\RealtyManager $realtyManager
    )
    {
        $this->realtyManager = $realtyManager;
    }

    public function indexAction()
    {
        $realtyHot = $this->realtyManager->getRealtyHot(null,['id' => 'DESC']);
        $view = new ViewModel(['realtyHot' => $realtyHot]);
        $view->setTemplate('realty/hot');
        return $view;
    }
}