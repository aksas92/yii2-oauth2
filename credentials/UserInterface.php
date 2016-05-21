<?php

/**
 * @author mylampblog@163.com
 */

namespace pfdtk\oauth2\credentials;

interface UserInterface
{
    /**
     * @return \pfdtk\oauth2\entities\UserEntity
     */
    public function checkUserCredentials($username, $password);
}