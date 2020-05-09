<?php

namespace Yu\Content\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Yu\Content\Entity\Block;


class BlockRepository extends EntityRepository
{
    /**
     * @param int $id
     * @return object|null
     */
    public function findBlockById($id)
    {
        $entity = $this->getEntityManager()->getRepository(Block::class)->find($id);

        if(empty($entity)) {
            $entity = new Block();
        }

        return $entity;
    }

    /**
     * @return array|object[]
     */
    public function findAllBlocks()
    {
        $entities = $this->getEntityManager()->getRepository(Block::class)->findAll();
        return $entities;
    }

    /**
     * @param Block $block
     * @return int
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Block $block)
    {
        $currentDate = new \DateTime("now");
        $block->setCreatedAt($currentDate);
        $block->setUpdatedAt($currentDate);
        $this->getEntityManager()->persist($block);
        $this->getEntityManager()->flush();

        return $block->getId();
    }

    /**
     * @param Block $page
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove(Block $block)
    {
        $this->getEntityManager()->remove($block);
        $this->getEntityManager()->flush();
    }
}