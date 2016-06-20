<?php

/**
 * @author mylampblog@163.com
 */

namespace pfdtk\oauth2\grant;

interface GrantInterface
{
    /**
     * @return \League\OAuth2\Server\AuthorizationServer
     */
    public function handle();
}