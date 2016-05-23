<?php

/**
 * @author mylampblog@163.com
 */

namespace pfdtk\oauth2\repository;

use League\OAuth2\Server\Repositories\AccessTokenRepositoryInterface;
use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use pfdtk\oauth2\entities\AccessTokenEntity;
use pfdtk\oauth2\models\AccessTokensModel;
use pfdtk\oauth2\models\AccessTokenScopesModel;

class AccessTokenRepository implements AccessTokenRepositoryInterface
{
    /**
     * Create a new access token
     *
     * @param \League\OAuth2\Server\Entities\ClientEntityInterface $clientEntity
     * @param \League\OAuth2\Server\Entities\ScopeEntityInterface[] $scopes
     * @param mixed $userIdentifier
     *
     * @return AccessTokenEntityInterface
     */
    public function getNewToken(ClientEntityInterface $clientEntity, array $scopes, $userIdentifier = null)
    {
        return new AccessTokenEntity();
    }

    /**
     * Persists a new access token to permanent storage.
     *
     * @param \League\OAuth2\Server\Entities\AccessTokenEntityInterface $accessTokenEntity
     * @return mixed
     */
    public function persistNewAccessToken(AccessTokenEntityInterface $accessTokenEntity)
    {
        $accessTokenModel = new AccessTokensModel();
        $accessTokenModel->id = $accessTokenEntity->getIdentifier();
        $accessTokenModel->expire_time = $accessTokenEntity->getExpiryDateTime()->getTimestamp();
        $accessTokenModel->user_id = $accessTokenEntity->getUserIdentifier();
        $accessTokenModel->client_id = $accessTokenEntity->getClient()->getIdentifier();
        if (!$accessTokenModel->save()) {
            return false;
        }

        foreach ($accessTokenEntity->getScopes() as $item) {
            $accessTokenScopesModel = new AccessTokenScopesModel();
            $accessTokenScopesModel->access_token_id = $accessTokenModel->id;
            $accessTokenScopesModel->scope_id = $item->getIdentifier();
            $accessTokenScopesModel->save();
        }

        return true;
    }

    /**
     * Revoke an access token.
     *
     * @param string $tokenId
     */
    public function revokeAccessToken($tokenId)
    {
        /** @var \yii\db\ActiveRecord $obj */
        $obj = AccessTokensModel::findOne(['id' => $tokenId]);
        if ($obj) $obj->delete();
    }

    /**
     * Check if the access token has been revoked.
     *
     * @param string $tokenId
     *
     * @return bool Return true if this token has been revoked
     */
    public function isAccessTokenRevoked($tokenId)
    {
        return !AccessTokensModel::findOne(['id' => $tokenId]) ? true : false;
    }
}