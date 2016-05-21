<?php

/**
 * @author mylampblog@163.com
 */

namespace pfdtk\oauth2\entities;

use League\OAuth2\Server\Entities\UserEntityInterface;
use League\OAuth2\Server\Entities\Traits\EntityTrait;

class UserEntity implements UserEntityInterface
{
    use EntityTrait;
}