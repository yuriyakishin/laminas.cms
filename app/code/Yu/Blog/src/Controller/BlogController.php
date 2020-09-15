<?php

namespace Yu\Blog\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Laminas\Paginator\Paginator;
use Yu\Blog\Entity\Rubric;
use Yu\Blog\Entity\Post;

class BlogController extends AbstractActionController
{
    public function rubricAction()
    {
        $identifier = $this->params('identifier');
        $page = $this->getRequest()->getQuery('page');

        $repositoryRubric = $this->entityManager()->getRepository(Rubric::class);
        $rubric = $repositoryRubric->findOneByIdentifier($identifier);

        $repositoryPost = $this->entityManager()->getRepository(Post::class);
        /** @var \Doctrine\ORM\Query $queryPosts */
        $queryPosts = $repositoryPost->queryPostsByRubric($rubric->getId());
        //$posts = $queryPosts->getResult();

        $adapter = new DoctrineAdapter(new ORMPaginator($queryPosts, false));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(10);
        $paginator->setCurrentPageNumber($page);

        $view = new ViewModel([
            'rubric' => $rubric,
            'posts' => $paginator,
            'path' => 'page',
            'entity_id' => $rubric->getId()]);
        $view->setTemplate('yu/blog/rubric');
        return $view;
    }

    public function postAction()
    {
        $identifier = $this->params('identifier');

        $repository = $this->entityManager()->getRepository(Post::class);

        $post = $repository->findOneByIdentifier($identifier);

        $view = new ViewModel(['post' => $post, 'path' => 'post', 'entityId' => $post->getId()]);
        $view->setTemplate('yu/blog/post');
        return $view;
    }

}