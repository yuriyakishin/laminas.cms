<?php

namespace Yu\Content\Route;

use Laminas\Router\Http\RouteInterface;
use Laminas\Router\Http\RouteMatch;
use Laminas\Stdlib\RequestInterface as Request;
use Yu\Content\Entity\Page as PageEntity;

class Page implements RouteInterface
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * @var array
     */
    private $options;

    public function __construct($options = [])
    {
        $this->options = $options;
    }

    /**
     * @param \Doctrine\ORM\EntityManager $entityManager
     * @return $this
     */
    public function setEntityManager(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getAssembledParams()
    {
        // TODO: Implement getAssembledParams() method.
    }

    /**
     * @inheritDoc
     */
    public static function factory($options = [])
    {
        return self;
    }

    /**
     * @inheritDoc
     */
    public function match(Request $request, $pathOffset = null)
    {
        if (! method_exists($request, 'getUri')) {
            return null;
        }

        $uri  = $request->getUri();
        $path = $uri->getPath();
        $pathArray = explode("/",$path);

        if (count($pathArray) === 2) {

            $repository = $this->entityManager->getRepository(PageEntity::class);

            /** @var \Yu\Content\Entity\Page $page */
            $page = $repository->findOneByIdentifier($pathArray[1]);

            if(!empty($page) && $page->getActive()==1) {
                $matchedLength = strlen($path);
                return new RouteMatch([
                    'controller' => \Yu\Content\Controller\PageController::class,
                    'action' => 'index',
                    'identifier' => $page->getIdentifier(),
                ], $matchedLength);
            }
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    public function assemble(array $params = [], array $options = [])
    {
        // TODO: Implement assemble() method.
    }

}