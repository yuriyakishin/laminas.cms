<?php

namespace Yu\User\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Yu\User\Entity\User as User;

class UserRepository extends EntityRepository
{
    public function getUserById($id)
    {
        $user = $this->getEntityManager()->getRepository(User::class)->find($id);
        return $user;
    }
}