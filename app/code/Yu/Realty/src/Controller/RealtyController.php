<?php

namespace Yu\Realty\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Laminas\Paginator\Paginator;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrinePaginatorAdapter;
use Yu\Realty\Service\RealtyConfigManager;
use Yu\Realty\Service\RealtyManager;
use Yu\Seo\Entity\Meta;
use Yu\Seo\Model\Meta as MetaModel;
use Yu\Realty\Entity\Realty;
use Yu\Geo\Entity\Marker;
use Yu\Realty\Repository\RealtyRepositoryInterface;
use Yu\Content\Entity\Page;
use Yu\Core\DataHelper;

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
     * @var \Yu\Realty\Api\SearchCriteriaBuilderInterface
     */
    private $searchCriteriaBuilder;

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
        \Yu\Realty\Api\SearchCriteriaBuilderInterface $searchCriteriaBuilder,
        array $data = []
    )
    {
        $this->realtyManager = $realtyManager;
        $this->repository = $repository;
        $this->options = $realtyConfigManager->getRealtyAdminOptions();
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    public function indexAction()
    {
        $page = $this->getRequest()->getQuery('page', 0);
        $params = $this->params()->fromQuery();
        $queryBuilder = $this->repository->getQueryBuilder();
        $query = $this->searchCriteriaBuilder->build($queryBuilder, $params)->getQuery();

        // Создаем пагинатор.
        $ormPaginator = new ORMPaginator($query, false);
        $ormPaginator->setUseOutputWalkers(false);
        $adapter = new DoctrinePaginatorAdapter($ormPaginator);
        $paginator = new Paginator($adapter);

        $paginator->setCurrentPageNumber($page);
        $paginator->setDefaultItemCountPerPage(20);

        $contentPage = $this->entityManager()->getRepository(Page::class)->findOneByIdentifier($this->options['type']);

        $view = new ViewModel([
            'realtyArray' => $paginator,
            'options' => $this->options,
            'params' => $params,
        ]);

        if(!empty($contentPage)) {
            $view->setVariables(['path' => 'page',
                'entityId' => $contentPage->getId(),
                'contentPage' => $contentPage,]);
        }

        $view->setTemplate('realty/catalog');
        return $view;
    }

    public function viewAction()
    {
        $id = $this->params('id');
        //$realty = $this->repository->findRealty([['where' => 'r.id=:id', 'param' => ['key' => ':id', 'value' => $id]]]);
        $queryBuilder = $this->repository->getQueryBuilder();
        $realty = $this->searchCriteriaBuilder->build($queryBuilder, ['id' => $id])->getQuery()->getResult();

        $meta = $this->entityManager()->getRepository(Meta::class)->findMeta('realty', $id);

        $attr = $this->realtyManager->getRealtyParamsV2($id, $realty[0]['type']);

        if (empty(DataHelper::getCurrentLangValue($meta->getTitle()))) {
            $metaModel = MetaModel::getInstance();
            $title = (string)$attr['anons'];
            $metaModel->setTitle($title);
        }

        if (empty(DataHelper::getCurrentLangValue($meta->getDescription()))) {
            $metaModel = MetaModel::getInstance();
            $description = (string)$attr['about'];
            $metaModel->setDescription($description);
        }

        $view = new ViewModel([
            'realty' => $realty[0],
            'path' => 'realty',
            'entity_id' => $id,
        ]);
        $view->setTemplate('realty/view');
        return $view;
    }
}