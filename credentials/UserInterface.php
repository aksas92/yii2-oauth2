<?php

/**
 * @author mylampblog@163.com
 */

namespace pfdtk\oauth2\credentials;

interface UserInterface
{
    /**
     * {@inheritdoc}
     */
    public function checkUserCredentials($username, $password);
}