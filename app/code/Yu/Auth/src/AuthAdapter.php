<?php

namespace Yu\Admin\Auth;

use Laminas\Authentication\Result;

class AuthAdapter implements \Laminas\Authentication\Adapter\AdapterInterface
{
    /**
     * @var \Yu\Admin\Api\UserInterface
     */
    private $userManager;

    public function __construct(
        \Yu\Admin\Api\UserInterface $userManager
    )
    {
        $this->userManager = $userManager;
    }

    /**
     * Performs an authentication attempt
     *
     * @return \Laminas\Authentication\Result
     * @throws \Laminas\Authentication\Adapter\Exception\ExceptionInterface If authentication cannot be performed
     */
    public function authenticate()
    {
        // TODO: Implement authenticate() method.
    }

}