<?php

namespace Yu\Realty\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Yu\Realty\Service\RealtyConfigManager;
use Yu\Realty\Service\RealtyManager;
use Yu\Seo\Entity\Meta;
use Yu\Realty\Entity\Realty;
use Yu\Geo\Entity\Marker;
use Yu\Realty\Repository\RealtyRepositoryInterface;

class RealtyController extends AbstractActionController
{
    /**
     * @var \Yu\Realty\Repository\RealtyRepositoryInterface
     */
    private $repository;

    /**
     * @var \Yu\Admin\Service\Table\TableManager
     */
    private $tableManager;

    /**
     * @var \Yu\Admin\Service\Form\FormManager
     */
    private $formManager;

    /**
     * @var RealtyManager
     */
    private $realtyManager;

    /**
     * @var array
     */
    private $options;

    /**
     * RealtyController constructor.
     * @param RealtyManager $realtyManager
     * @param RealtyRepositoryInterface $repository
     * @param array $data
     */
    public function __construct(
        \Yu\Realty\Service\RealtyManager $realtyManager,
        \Yu\Realty\Service\RealtyConfigManager $realtyConfigManager,
        \Yu\Realty\Repository\RealtyRepositoryInterface $repository,
        array $data = []
    )
    {
        $this->realtyManager = $realtyManager;
        $this->repository = $repository;
        $this->options = $realtyConfigManager->getRealtyAdminOptions();
    }

    public function indexAction()
    {
        $realty = $this->repository->findRealty();

        $view = new ViewModel([
            'realtyArray' => $realty
        ]);
        $view->setTemplate('realty/catalog');
        return $view;
    }

    public function viewAction()
    {
        $id = $this->params('id');
        $realty = $this->repository->findRealty([['where' => 'r.id=:id', 'param' => ['key' => ':id', 'value' => $id]]]);

        $view = new ViewModel([
            'realty' => $realty[0]
        ]);
        $view->setTemplate('realty/view');
        return $view;
    }
}