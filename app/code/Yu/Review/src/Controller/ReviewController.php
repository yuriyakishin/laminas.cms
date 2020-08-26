<?php
namespace Yu\Review\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Laminas\Paginator\Paginator;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrinePaginatorAdapter;
use Yu\Review\Entity\Review;

class ReviewController extends AbstractActionController
{
    public function indexAction()
    {
        $page = $this->getRequest()->getQuery('page', 0);

        $repository = $this->entityManager()->getRepository(Review::class);
        /** @var \Doctrine\ORM\Query $query */
        $query = $repository->getQuery();

        // Создаем пагинатор.
        $ormPaginator = new ORMPaginator($query, false);
        $ormPaginator->setUseOutputWalkers(false);
        $adapter = new DoctrinePaginatorAdapter($ormPaginator);
        $paginator = new Paginator($adapter);

        $paginator->setCurrentPageNumber($page);
        $paginator->setDefaultItemCountPerPage(10);

        $view = new ViewModel(['paginator' => $paginator]);
        $view->setTemplate('yu/review');
        return $view;
    }
}