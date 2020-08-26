<?php

namespace Yu\Board\View\Helper;

use Laminas\View\Helper\AbstractHelper;
use Yu\Board\Entity\Board;
use Yu\Board\Entity\BoardType;
use Yu\Board\Entity\BoardCity;

class BoardHelper extends AbstractHelper
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

    public function getBoard(array $criteria = null, array $order = null, int $limit = null)
    {
        $repository = $this->entityManager->getRepository(Board::class);
        $board = $repository->findBoard($criteria, $order, $limit);
        if (empty($board)) {
            $board = [];
        }
        return $board;
    }

    public function getTypes()
    {
        $repository = $this->entityManager->getRepository(BoardType::class);
        $entities = $repository->findAll();
        if (empty($entities)) {
            $entities = [];
        }
        return $entities;
    }

    public function getCities()
    {
        $repository = $this->entityManager->getRepository(BoardCity::class);
        $entities = $repository->findAll();
        if (empty($entities)) {
            $entities = [];
        }
        return $entities;
    }

}