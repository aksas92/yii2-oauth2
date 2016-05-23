<?php

/**
 * @author mylampblog@163.com
 */

namespace pfdtk\oauth2\repository;

use League\OAuth2\Server\Repositories\ClientRepositoryInterface;
use pfdtk\oauth2\models\ClientModel;
use pfdtk\oauth2\models\GrantsModel;
use pfdtk\oauth2\models\ScopesModel;
use pfdtk\oauth2\models\ClientProfileModel;
use pfdtk\oauth2\models\ClientGrantsModel;
use pfdtk\oauth2\models\ClientScopesModel;
use pfdtk\oauth2\entities\ClientEntity;
use yii\helpers\ArrayHelper;

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
     * @return mixed
     */
    public function addNewClient($identifier, $secret, $name, $redirectUri)
    {
        $clientModel = new ClientModel();
        $clientModel->id = $identifier;
        $clientModel->secret = $secret;
        $clientModel->name = $name;
        if (!$clientModel->save()) {
            return false;
        }

        $clientProfile = new ClientProfileModel();
        $clientProfile->client_id = $clientModel->id;
        $clientProfile->redirect_uri = $redirectUri;

        return $clientProfile->save();
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
     * @return boolean
     */
    public function bindClientGrant(array $data)
    {
        $clientIdentifiers = array_keys($data);
        $grantIdentifiers = array_values($data);

        $clientsInDb = ArrayHelper::getColumn(ClientModel::findByClientId($clientIdentifiers)->all(), 'id');
        $grantsInDb = ArrayHelper::getColumn(GrantsModel::findByGrantId($grantIdentifiers)->all(), 'id');

        if (count(array_diff($clientIdentifiers, $clientsInDb)) !== 0
            or count(array_diff($grantIdentifiers, $grantsInDb)) !== 0
        ) {
            return false;
        }

        foreach ($data as $client => $grant) {
            $clientGrantModel = new ClientGrantsModel();
            $clientGrantModel->client_id = $client;
            $clientGrantModel->grant_id = $grant;
            $clientGrantModel->save();
        }

        return true;
    }

    /**
     * @param  string $clientIdentifier
     * @param  string $grant |null
     */
    public function removeClientGrant($clientIdentifier, $grant = null)
    {
        $condition = ['id' => $clientIdentifier];
        if ($grant) {
            $condition['grant_id'] = $grant;
        }
        $grants = ClientGrantsModel::findAll($condition);

        foreach ($grants as $grant) {
            $grant->delete();
        }
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
     * @return boolean
     */
    public function bindClientScope(array $data)
    {
        $clientIdentifiers = array_keys($data);
        $scopeIdentifiers = array_values($data);

        $clientsInDb = ArrayHelper::getColumn(ClientModel::findByClientId($clientIdentifiers)->all(), 'id');
        $scopesInDb = ArrayHelper::getColumn(ScopesModel::findByScopeId($scopeIdentifiers)->all(), 'id');

        if (count(array_diff($clientIdentifiers, $clientsInDb)) !== 0
            or count(array_diff($scopeIdentifiers, $scopesInDb)) !== 0
        ) {
            return false;
        }

        foreach ($data as $client => $scope) {
            $clientScopeModel = new ClientScopesModel();
            $clientScopeModel->client_id = $client;
            $clientScopeModel->grant_id = $scope;
            $clientScopeModel->save();
        }

        return true;
    }

    /**
     * @param  string $clientIdentifier
     * @param  string $scope |null
     */
    public function removeClientScope($clientIdentifier, $scope = null)
    {
        $condition = ['id' => $clientIdentifier];
        if ($scope) {
            $condition['scope_id'] = $scope;
        }
        $scopes = ClientScopesModel::findAll($condition);

        foreach ($scopes as $scope) {
            $scope->delete();
        }
    }

}