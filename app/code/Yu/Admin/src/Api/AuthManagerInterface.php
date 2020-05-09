<?php

namespace Yu\Admin\Api;

interface AuthManagerInterface
{
    /**
     * Returns the authenticated identity or null if no identity is available
     *
     * @return mixed|null
     */
    public function getIdentity();

    /**
     * Returns true if and only if an identity is available
     *
     * @return bool
     */
    public function hasIdentity();

    /**
     * @param string $identity
     * @param string $credential
     * @param bool $remembe
     * @return mixed
     */
    public function login(string $identity, string $credential, bool $remembe);

    /**
     * @return void
     */
    public function logout();

}