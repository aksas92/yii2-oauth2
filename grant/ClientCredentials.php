<?php

/**
 * @author mylampblog@163.com
 */

namespace pfdtk\oauth2\grant;

use Yii;
use pfdtk\oauth2\config\ConfigInterface;
use pfdtk\oauth2\repository\ClientRepository;
use pfdtk\oauth2\repository\ScopeRepository;
use pfdtk\oauth2\repository\AccessTokenRepository;
use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\Grant\ClientCredentialsGrant;

class ClientCredentials implements GrantInterface
{
    /**
     * handle
     */
    public function handle()
    {
        $clientRepository = new ClientRepository();
        $scopeRepository = new ScopeRepository();
        $accessTokenRepository = new AccessTokenRepository();

        $config = Yii::$container->get(ConfigInterface::class);
        $privateKey = $config->get('privateKeyPath');
        $publicKey = $config->get('publicKeyPath');

        $server = new AuthorizationServer(
            $clientRepository,
            $accessTokenRepository,
            $scopeRepository,
            $privateKey,
            $publicKey
        );

        $accessTokenTTL = $config->get('accessTokenTTL', 'PT1H');

        $server->enableGrantType(
            new ClientCredentialsGrant(),
            new \DateInterval($accessTokenTTL)
        );

        return $server;
    }
}