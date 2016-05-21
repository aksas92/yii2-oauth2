<?php

/**
 * @author mylampblog@163.com
 */

namespace pfdtk\oauth2\repository;

use League\OAuth2\Server\Repositories\UserRepositoryInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use pfdtk\oauth2\entities\UserEntity;

class UserRepository implements UserRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function getUserEntityByUserCredentials($username, $password, $grantType, ClientEntityInterface $clientEntity)
    {
        return new UserEntity();
    }
}