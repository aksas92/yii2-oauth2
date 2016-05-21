<?php

/**
 * @author mylampblog@163.com
 */

namespace pfdtk\oauth2\repository;

use League\OAuth2\Server\Repositories\RefreshTokenRepositoryInterface;
use pfdtk\oauth2\entities\RefreshTokenEntity;
use League\OAuth2\Server\Entities\RefreshTokenEntityInterface;
use pfdtk\oauth2\models\RefreshTokensModel;

class RefreshTokenRepository implements RefreshTokenRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function persistNewRefreshToken(RefreshTokenEntityInterface $refreshTokenEntityInterface)
    {
        $refreshTokenModel = new RefreshTokensModel();
        $refreshTokenModel->id = $refreshTokenEntityInterface->getIdentifier();
        $refreshTokenModel->access_token_id = $refreshTokenEntityInterface->getAccessToken()->getIdentifier();
        $refreshTokenModel->expire_time = $refreshTokenEntityInterface->getExpiryDateTime()->getTimestamp();
        $refreshTokenModel->save();
    }

    /**
     * {@inheritdoc}
     */
    public function revokeRefreshToken($tokenId)
    {
        /** @var \yii\db\ActiveRecord $obj */
        $obj = RefreshTokensModel::findOne(['id' => $tokenId]);
        $obj->delete();
    }

    /**
     * {@inheritdoc}
     */
    public function isRefreshTokenRevoked($tokenId)
    {
        return !RefreshTokensModel::findOne(['id' => $tokenId]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function getNewRefreshToken()
    {
        return new RefreshTokenEntity();
    }
}