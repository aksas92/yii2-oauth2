<?php

/**
 * @author mylampblog@163.com
 */

namespace pfdtk\oauth2\entities;

use League\OAuth2\Server\Entities\RefreshTokenEntityInterface;
use League\OAuth2\Server\Entities\Traits\RefreshTokenTrait;
use League\OAuth2\Server\Entities\Traits\EntityTrait;

class RefreshTokenEntity implements RefreshTokenEntityInterface
{
    use RefreshTokenTrait;
    use EntityTrait;
}