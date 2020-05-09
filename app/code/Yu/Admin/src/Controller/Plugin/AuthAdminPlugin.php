<?php

namespace Yu\Admin\Controller\Plugin;

use Laminas\Mvc\Controller\Plugin\AbstractPlugin;

class AuthAdminPlugin extends AbstractPlugin
{
    /**
     * @var \Yu\Admin\Api\AuthManagerInterface
     */
    private $authManager;

    /**
     * @var \Yu\Admin\Service\User\AdminUserManager
     */
    private $adminUserManager;

    /**
     * AuthAdminPlugin constructor.
     * @param \Yu\Admin\Api\AuthManagerInterface $authManager
     * @param \Yu\Admin\Service\User\AdminUserManager $adminUserManager
     */
    public function __construct(
        \Yu\Admin\Api\AuthManagerInterface $authManager,
        \Yu\Admin\Service\User\AdminUserManager $adminUserManager
    )
    {
        $this->authManager = $authManager;
        $this->adminUserManager = $adminUserManager;
    }

    /**
     * @return |null
     */
    public function checkUser()
    {
        $this->adminUserManager->createAdminUserIfNotExists();

        if (!$this->authManager->getIdentity()) {
            return $this->getController()->redirect()->toRoute('admin/login');
        }

        return null;
    }

    /**
     * @return mixed|null
     */
    public function getIdentity()
    {
        if($this->authManager->hasIdentity())
        {
            return $this->authManager->getIdentity();
        }

        return null;
    }

    /**
     * @return \Yu\User\Entity\User|null
     */
    public function getCurrentUser()
    {
        return $this->adminUserManager->getCurrentUser();
    }

    /**
     * @param string $identity
     * @param string $credential
     * @param bool $remember
     * @return mixed
     */
    public function login(string $identity, string $credential, bool $remember = false)
    {
        return $this->authManager->login($identity,$credential,$remember);
    }

    /**
     * @return void
     */
    public function logout()
    {
        $this->authManager->logout();
    }
}