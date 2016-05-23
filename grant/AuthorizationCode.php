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
use pfdtk\oauth2\repository\AuthCodeRepository;
use pfdtk\oauth2\repository\RefreshTokenRepository;
use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\Grant\AuthCodeGrant;

class AuthorizationCode implements GrantInterface
{
    /**
     * handle
     */
    public function handle()
    {
        $clientRepository = new ClientRepository();
        $scopeRepository = new ScopeRepository();
        $accessTokenRepository = new AccessTokenRepository();
        $authCodeRepository = new AuthCodeRepository();
        $refreshTokenRepository = new RefreshTokenRepository();

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

        $codeTTL = $config->get('codeTTL', 'PT10M');
        $refreshTokenTTL = $config->get('refreshTokenTTL', 'P1M');
        $accessTokenTTL = $config->get('accessTokenTTL', 'PT1H');

        $grant = new AuthCodeGrant(
            $authCodeRepository,
            $refreshTokenRepository,
            new \DateInterval($codeTTL)
        );

        $grant->setRefreshTokenTTL(new \DateInterval($refreshTokenTTL));

        $server->enableGrantType(
            $grant,
            new \DateInterval($accessTokenTTL)
        );

        return $server;
    }
}