<?php

namespace Yu\Admin\Service\User;

use Laminas\Crypt\Password\Bcrypt;

class AuthManager implements \Yu\Admin\Api\AuthManagerInterface
{
    /**
     * @var \Laminas\Authentication\AuthenticationServiceInterface
     */
    private $authService;

    /**
     * @var \Laminas\Session\SessionManager
     */
    private $sessionManager;

    /**
     * AuthManager constructor.
     * @param \Laminas\Authentication\AuthenticationServiceInterface $authService
     * @param \Laminas\Session\SessionManager $sessionManager
     */
    public function __construct(
        \Laminas\Authentication\AuthenticationServiceInterface $authService,
        \Laminas\Session\SessionManager $sessionManager
    )
    {
        $this->authService = $authService;
        $this->sessionManager = $sessionManager;
    }

    /**
     * @inheritDoc
     */
    public function getIdentity()
    {
        if ($this->authService->hasIdentity()) {
            return $this->authService->getIdentity();
        }
        return null;
    }

    /**
     * @inheritDoc
     */
    public function hasIdentity()
    {
        return $this->authService->hasIdentity();
    }

    /**
     * @inheritDoc
     */
    public function login(string $identity, string $credential, bool $remember = false)
    {
        $this->authService->getAdapter()->setIdentity($identity);
        $this->authService->getAdapter()->setCredential($credential);
        /** @var \Laminas\Authentication\Result $result */
        $result = $this->authService->authenticate();

        if ($result->isValid()) {
            if ($remember) {
                $this->sessionManager->rememberMe(60 * 60 * 24 * 30);
            }
            return true;
        }

        return false;
    }

    public function logout()
    {
        $this->authService->clearIdentity();
    }

    /**
     * @param $identity
     * @param $credentialValue
     * @return bool
     */
    public static function verifyCredential($identity, $credentialValue)
    {
        $bcrypt = new Bcrypt();

        if ($bcrypt->verify($credentialValue, $identity->getPassword())) {
            return true;
        }

        return false;
    }
}