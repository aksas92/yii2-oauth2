<?php

/**
 * @author mylampblog@163.com
 */

namespace pfdtk\oauth2\repository;

use League\OAuth2\Server\Repositories\AuthCodeRepositoryInterface;
use League\OAuth2\Server\Entities\AuthCodeEntityInterface;
use pfdtk\oauth2\entities\AuthCodeEntity;
use pfdtk\oauth2\models\AuthCodesModel;
use pfdtk\oauth2\models\AuthCodeScopesModel;

class AuthCodeRepository implements AuthCodeRepositoryInterface
{
    /**
     * Creates a new AuthCode
     *
     * @return \League\OAuth2\Server\Entities\AuthCodeEntityInterface
     */
    public function getNewAuthCode()
    {
        $authCodeEntity = new AuthCodeEntity();

        return $authCodeEntity;
    }

    /**
     * Persists a new auth code to permanent storage.
     *
     * @param \League\OAuth2\Server\Entities\AuthCodeEntityInterface $authCodeEntity
     */
    public function persistNewAuthCode(AuthCodeEntityInterface $authCodeEntity)
    {
        $authCodeModel = new AuthCodesModel();
        $authCodeModel->id = $authCodeEntity->getIdentifier();
        $authCodeModel->expire_time = $authCodeEntity->getExpiryDateTime()->getTimestamp();
        $authCodeModel->user_id = $authCodeEntity->getUserIdentifier();
        $authCodeModel->client_id = $authCodeEntity->getClient()->getIdentifier();
        $authCodeModel->save();

        foreach ($authCodeEntity->getScopes() as $item) {
            $accessTokenScopesModel = new AuthCodeScopesModel();
            $accessTokenScopesModel->auth_code_id = $authCodeModel->id;
            $accessTokenScopesModel->scope_id = $item->getIdentifier();
            $accessTokenScopesModel->save();
        }
    }

    /**
     * Revoke an auth code.
     *
     * @param string $codeId
     */
    public function revokeAuthCode($codeId)
    {
        /** @var \yii\db\ActiveRecord $obj */
        $obj = AuthCodesModel::findOne(['id' => $codeId]);
        $obj->delete();
    }

    /**
     * Check if the auth code has been revoked.
     *
     * @param string $codeId
     *
     * @return bool Return true if this code has been revoked
     */
    public function isAuthCodeRevoked($codeId)
    {
        return !AuthCodesModel::findOne(['id' => $codeId]);
    }
}