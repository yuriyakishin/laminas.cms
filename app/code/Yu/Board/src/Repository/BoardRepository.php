<?php

namespace Yu\Board\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Yu\Board\Entity\Board;
use Yu\Board\Entity\BoardCity;
use Yu\Board\Entity\BoardType;

class BoardRepository extends EntityRepository
{
    /**
     * @return \Doctrine\ORM\Query
     */
    public function getQuery()
    {
        $queryBuilder = $this->getQueryBuilder();
        $query = $queryBuilder->getQuery();
        return $query;
    }

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getQueryBuilder()
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();

        $queryBuilder
            ->addSelect('board.id as id')
            ->addSelect('board.person as person')
            ->addSelect('board.date as date')
            ->addSelect('board.message as message')
            ->addSelect('board.phone as phone')
            ->addSelect('board.email as email')
            ->addSelect('board.view as view')
            ->addSelect('board.typeId as type_id')
            ->addSelect('board.cityId as city_id')
            ->addSelect('t.name as type')
            ->addSelect('c.name as city')
            ->from(Board::class, 'board')
            ->leftJoin(BoardCity::class, 'c', Join::WITH, 'c.id=board.cityId')
            ->leftJoin(BoardType::class, 't', Join::WITH, 't.id=board.typeId');

        return $queryBuilder;
    }

    public function findBoard(array $criteria = null, array $order = null, int $limit = null)
    {
        $queryBuilder = $this->getQueryBuilder();
        if ($criteria !== null) {
            $i = 1;
            foreach ($criteria as $key => $val) {
                $queryBuilder->andWhere($key.' = '.'?'.$i);
                $queryBuilder->setParameter($i, $val);
                $i++;
            }
        }

        if ($order !== null) {
            $queryBuilder->addOrderBy($order);
        }

        if($limit !== null) {
            $queryBuilder->setMaxResults($limit);
        }

        $query = $queryBuilder->getQuery();

        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * @param Board $entity
     * @return int
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Board $entity)
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();

        return $entity->getId();
    }

    public function remove(Board $entity)
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }
}