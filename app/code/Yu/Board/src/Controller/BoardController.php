<?php

namespace Yu\Board\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Laminas\Paginator\Paginator;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrinePaginatorAdapter;
use Yu\Board\Entity\Board;

class BoardController extends AbstractActionController
{
    public function indexAction()
    {
        $page = $this->getRequest()->getQuery('page', 0);
        $type = $this->getRequest()->getQuery('type', 0);
        $city = $this->getRequest()->getQuery('city', 0);

        $repository = $this->entityManager()->getRepository(Board::class);
        /** @var \Doctrine\ORM\QueryBuilder $queryBuilder */
        $queryBuilder = $repository->getQueryBuilder();
        $queryBuilder->andWhere('board.view=1');
        if (!empty($type)) {
            $queryBuilder->andWhere('board.typeId=:type');
            $queryBuilder->setParameter('type', $type);
        }
        if (!empty($city)) {
            $queryBuilder->andWhere('board.cityId=:city');
            $queryBuilder->setParameter('city', $city);
        }
        $queryBuilder->addOrderBy('date', 'DESC');
        $query = $queryBuilder->getQuery();

        // Создаем пагинатор.
        $ormPaginator = new ORMPaginator($query, false);
        $ormPaginator->setUseOutputWalkers(false);
        $adapter = new DoctrinePaginatorAdapter($ormPaginator);
        $paginator = new Paginator($adapter);

        $paginator->setCurrentPageNumber($page);
        $paginator->setDefaultItemCountPerPage(10);

        $view = new ViewModel(['paginator' => $paginator, 'typeId' => $type, 'cityId' => $city]);
        $view->setTemplate('yu/board');
        return $view;
    }

    public function formAction()
    {
        $view = new ViewModel();
        $view->setTemplate('yu/board/form');
        return $view;
    }

    public function sendAction()
    {
        $type = $this->params()->fromPost('board-type', '');
        $city = $this->params()->fromPost('board-city', '');
        $name = $this->params()->fromPost('board-name', '');
        $phone = $this->params()->fromPost('board-phone', '');
        $email = $this->params()->fromPost('board-email', '');
        $message = $this->params()->fromPost('board-message', '');

        if (!empty($type) && !empty($city) && !empty($name) && !empty($phone)) {
            $repository = $this->entityManager()->getRepository(Board::class);
            $board = new Board();
            $board->setCityId($city);
            $board->setTypeId($type);
            $board->setDate(date('U'));
            $board->setPerson($name);
            $board->setPhone($phone);
            $board->setEmail($email);
            $board->setMessage($message);
            $board->setView(0);
            $id = $repository->save($board);
        } else {
            $this->redirect()->toRoute('board');
        }

        $view = new ViewModel();
        $view->setTemplate('yu/board/send');
        return $view;
    }
}