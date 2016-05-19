<?php

/**
 * @author mylampblog@163.com
 */

namespace pfdtk\oauth2\repository;

use League\OAuth2\Server\Repositories\ClientRepositoryInterface;
use pfdtk\oauth2\models\ClientModel;

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
            if ($clientSecret) {
                ClientModel::findBySecret($clientSecret, $query);
            } else {
                return false;
            }
        }

        $result = $query->one();

        

    }
}