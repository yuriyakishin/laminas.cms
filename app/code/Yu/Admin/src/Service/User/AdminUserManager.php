<?php

namespace Yu\Admin\Service\User;

use Laminas\Crypt\Password\Bcrypt;
use Yu\User\Entity\User;

class AdminUserManager
{

    private $entityManager;

    /**
     * @var \Yu\Admin\Api\AuthManagerInterface
     */
    private $authManager;

    /**
     * @var \Yu\User\Entity\User|null
     */
    private $currentUser = null;

    /**
     * AdminUserManager constructor.
     * @param $entityManager
     * @param \Yu\Admin\Api\AuthManagerInterface $authManager
     */
    public function __construct(
        $entityManager,
        \Yu\Admin\Api\AuthManagerInterface $authManager
    )
    {
        $this->entityManager = $entityManager;
        $this->authManager = $authManager;
    }

    /**
     * @return User|null
     */
    public function getCurrentUser()
    {
        if(!empty($this->currentUser)) {
            return $this->currentUser;
        }

        $this->currentUser = $this->entityManager->getRepository(User::class)->find($this->authManager->getIdentity());
        return $this->currentUser;
    }

    /**
     * This method checks if at least one user presents, and if not, creates
     * 'Admin' user with email 'admin@admin.com' and password '11111'.
     */
    public function createAdminUserIfNotExists()
    {
        $user = $this->entityManager->getRepository(User::class)->findOneBy([]);

        if ($user==null) {
            $user = new User();
            $user->setEmail('admin@admin.com');
            $user->setName('Admin');
            $bcrypt = new Bcrypt();
            $passwordHash = $bcrypt->create('11111');
            $user->setPassword($passwordHash);
            $user->setStatus(1);
            $user->setRole('admin');
            $user->setSiteId(1);
            $user->setCreatedAt(new \DateTime("now"));
            $user->setUpdatedAt(new \DateTime("now"));

            $this->entityManager->persist($user);
            $this->entityManager->flush();
        }
    }

}