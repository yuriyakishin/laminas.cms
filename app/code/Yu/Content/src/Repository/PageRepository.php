<?php

namespace Yu\Content\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Yu\Content\Entity\Page;

class PageRepository extends EntityRepository
{
    /**
     * @param int $id
     * @return object|null
     */
    public function findPageById($id)
    {
        $entity = $this->getEntityManager()->getRepository(Page::class)->find($id);

        if(empty($entity)) {
            $entity = new Page();
        }

        return $entity;
    }

    /**
     * @return array|object[]
     */
    public function findAllPages()
    {
        $entities = $this->getEntityManager()->getRepository(Page::class)->findAll();
        return $entities;
    }

    /**
     * @param Page $page
     * @return int
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Page $page)
    {
        $currentDate = new \DateTime("now");
        $page->setCreatedAt($currentDate);
        $page->setUpdatedAt($currentDate);
        $this->getEntityManager()->persist($page);
        $this->getEntityManager()->flush();

        return $page->getId();
    }

    /**
     * @param Page $page
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove(Page $page)
    {
        $this->getEntityManager()->remove($page);
        $this->getEntityManager()->flush();
    }
}