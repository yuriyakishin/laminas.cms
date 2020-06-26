<?php

namespace Yu\Blog\View\Helper;

use Laminas\View\Helper\AbstractHelper;
use Yu\Blog\Entity\Rubric;
use Yu\Blog\Entity\Post;

class BlogHelper extends AbstractHelper
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * MetaHelper constructor.
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function __construct(
        \Doctrine\ORM\EntityManager $entityManager
    )
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param null $criteria
     * @param array $orderBy
     * @param array $limit
     * @return array|object[]
     */
    public function getPostsBy($criteria = [], $orderBy = null, $limit = null)
    {
        if(empty($criteria)) {
            $criteria = ['active' => 1];
        }

        $posts = $this->entityManager->getRepository(Post::class)->findBy($criteria, $orderBy, $limit);
        return $posts;
    }

    /**
     * @param $rubricId
     * @param null $order
     * @param null $limit
     * @return array|object[]
     */
    public function getPostsByRubric($rubricId, $order = null, $limit = null)
    {
        $posts = $this->entityManager->getRepository(Post::class)->findBy(['rubric_id' => $rubricId, 'active' => 1]);
        return $posts;
    }

    /**
     * @return array|object[]
     */
    public function getRubrics()
    {
        $rubrics = $this->entityManager->getRepository(Rubric::class)->findAll();
        return $rubrics;
    }
}