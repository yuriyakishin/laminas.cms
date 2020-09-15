<?php

namespace Yu\Gallery\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Laminas\Paginator\Paginator;
use Laminas\Paginator\Adapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrinePaginatorAdapter;
use Yu\Gallery\Entity\Gallery;
use Yu\Media\Entity\Image;

class GalleryController extends AbstractActionController
{
    private $options = array();

    public function __construct(array $options)
    {
        $this->options = $options;
    }

    public function indexAction()
    {
        $page = $this->getRequest()->getQuery('page', 0);
        $options = $this->options;
        $identifier = $options["identifier"];

        $repository = $this->entityManager()->getRepository(Gallery::class);
        $gallery = $repository->findOneByIdentifier($identifier);
        if (empty($gallery)) {
            return 'Not fount gallery';
        }

        $imageRepository = $this->entityManager()->getRepository(Image::class);
        $images = $imageRepository->findBy(['path' => 'gallery', 'pathId' => $gallery->getId()], ['sort' => 'ASC']);

        $paginator = new Paginator(new Adapter\ArrayAdapter($images));
        $paginator->setCurrentPageNumber($page);
        $paginator->setDefaultItemCountPerPage($options['count']);

        $view = new ViewModel(['gallery' => $gallery, 'paginator' => $paginator, 'images' => $images,'options' => $options,
            'metaKeys' => [
                'path' => 'gallery',
                'entityId' => $gallery->getId(),
                'paginator' => $paginator,
            ]]);

        $view->setTemplate($options['template']);
        return $view;
    }
}