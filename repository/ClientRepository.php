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

    /**
     * @param string $identifier
     * @param string $secret
     * @param string $name
     * @param string $redirectUri
     */
    public function addNewClient($identifier, $secret, $name, $redirectUri)
    {

    }

    /**
     * case:
     *
     * $data = [
     *     'clientIdentifier1' => 'grantIdentifier1',
     *     'clientIdentifier2' => 'grantIdentifier2'
     * ]
     * 
     * @param  array $data
     */
    public function bindClientGrant(array $data)
    {

    }

    /**
     * @param  string $identifier
     * @param  string $grant|null
     */
    public function removeClientGrant($identifier, $grant = null)
    {

    }

    /**
     * case:
     *
     * $data = [
     *     'clientIdentifier1' => 'scopeIdentifier1',
     *     'clientIdentifier2' => 'scopeIdentifier2'
     * ]
     * 
     * @param  array $data
     */
    public function bindClientScope(array $data)
    {

    }

    /**
     * @param  string $identifier
     * @param  string $scope|null
     */
    public function removeClientScope($identifier, $scope = null)
    {

    }

}