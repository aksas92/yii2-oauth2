<?php

/**
 * @author mylampblog@163.com
 */

namespace pfdtk\oauth2\repository;

use League\OAuth2\Server\Repositories\ClientRepositoryInterface;
use pfdtk\oauth2\models\ClientModel;
use pfdtk\oauth2\entities\ClientEntity;

class ClientRepository implements ClientRepositoryInterface
{
    /**
     * @param string $clientIdentifier
     * @param string $grantType
     * @param null $clientSecret
     * @param bool $mustValidateSecret
     *
     * @return \League\OAuth2\Server\Entities\ClientEntityInterface|boolean
     */
    public function getClientEntity($clientIdentifier, $grantType, $clientSecret = null, $mustValidateSecret = true)
    {
        $query = ClientModel::find();
        ClientModel::findByClientId($clientIdentifier, $query);
        ClientModel::findByGrantType($grantType, $query);

        if ($mustValidateSecret) {
            if (!$clientSecret) return false;
            ClientModel::findBySecret($clientSecret, $query);
        }

        if (!$result = $query->one()) {
            return false;
        }

        return $this->prepareClientEntity($result);
    }

    /**
     * @param $result
     * @return \League\OAuth2\Server\Entities\ClientEntityInterface
     */
    private function prepareClientEntity($result)
    {
        $clientEntity = new ClientEntity();
        $clientEntity->setIdentifier($result->id);
        $clientEntity->setName($result->name);
        $clientEntity->setRedirectUri($result->clientProfile->redirect_uri);
        return $clientEntity;
    }
}