<?php

/**
 * @author mylampblog@163.com
 */

namespace pfdtk\oauth2\entities;

use League\OAuth2\Server\Entities\ScopeEntityInterface;
use League\OAuth2\Server\Entities\Traits\EntityTrait;

class ScopeEntity implements ScopeEntityInterface
{
    use EntityTrait;

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $this->getIdentifier();
    }

}