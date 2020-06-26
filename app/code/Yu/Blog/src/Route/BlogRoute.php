<?php

namespace Yu\Blog\Route;

use Laminas\Router\Http\RouteInterface;
use Laminas\Router\Http\RouteMatch;
use Laminas\Stdlib\RequestInterface as Request;
use Laminas\Router\Exception;
use Yu\Blog\Entity\Rubric;
use Yu\Blog\Entity\Post;

class BlogRoute implements RouteInterface
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * @var array
     */
    private $options;

    /**
     * @var array
     */
    private $assembledParams;

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
        $this->assembledParams;
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

        if (count($pathArray) === 2 || count($pathArray) === 3) {

            $repository = $this->entityManager->getRepository(Rubric::class);

            /** @var \Yu\Blog\Entity\Rubric $rubric */
            $rubric = $repository->findOneByIdentifier($pathArray[1]);

            if(!empty($rubric)) {
                $matchedLength = strlen($path);

                if(count($pathArray) === 2) {
                    return new RouteMatch([
                        'controller' => \Yu\Blog\Controller\BlogController::class,
                        'action' => 'rubric',
                        'identifier' => $rubric->getIdentifier(),
                    ], $matchedLength);
                }

                if(count($pathArray) === 3) {
                    $posts = $rubric->getPosts();
                    if(!empty($posts)) {
                        /** @var \Yu\Blog\Entity\Post $post */
                        foreach ($posts as $post) {

                            if($pathArray[2] == $post->getIdentifier()) {
                                return new RouteMatch([
                                    'controller' => \Yu\Blog\Controller\BlogController::class,
                                    'action' => 'post',
                                    'identifier' => $post->getIdentifier(),
                                ], $matchedLength);
                            }
                        }
                    }
                }
            }
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    public function assemble(array $params = [], array $options = [])
    {
        if(!isset($params['path'])) {
            throw new Exception\InvalidArgumentException(__METHOD__ .
                ' expects the "path" parameter');
        }

        $url = '/' . $params['path'];
        if(isset($params['page'])) {
            $url = $url . '?page=' . $params['page'];
        }

        $this->assembledParams[] = 'page';

        return $url;
    }

}