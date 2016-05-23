<?php

/**
 * @author mylampblog@163.com
 */

namespace pfdtk\oauth2\repository;

use Yii;
use League\OAuth2\Server\Repositories\UserRepositoryInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use pfdtk\oauth2\entities\UserEntity;
use pfdtk\oauth2\credentials\UserInterface;
use pfdtk\oauth2\models\UserGrantsModel;
use pfdtk\oauth2\models\GrantsModel;
use pfdtk\oauth2\models\ClientModel;
use pfdtk\oauth2\models\ScopesModel;
use pfdtk\oauth2\models\UserClientsModel;
use pfdtk\oauth2\models\UserScopesModel;
use yii\helpers\ArrayHelper;

class UserRepository implements UserRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function getUserEntityByUserCredentials($username, $password, $grantType, ClientEntityInterface $clientEntity)
    {
        $container = Yii::$container;
        /** @var UserEntity $userEntity */
        $userEntity = $container->get(UserInterface::class)->checkUserCredentials($username, $password);
        if ($userEntity instanceof UserEntity === false) {
            return false;
        }

        $checkGrant = UserGrantsModel::findByUserId($userEntity->getIdentifier())->one();
        $checkClient = UserClientsModel::findByUserId($userEntity->getIdentifier())->one();
        if (!$checkClient or !$checkGrant) {
            return false;
        }

        return $userEntity;
    }

    /**
     * case:
     *
     * $data = [
     *     'UserIdentifier1' => 'ClientIdentifier1',
     *     'UserIdentifier2' => 'ClientIdentifier2'
     * ]
     *
     * @param  array $data
     * @return boolean
     */
    public function bindUserClient(array $data)
    {
        $clientIdentifiers = array_values($data);

        $clientsInDb = ArrayHelper::getColumn(ClientModel::findByClientId($clientIdentifiers)->all(), 'id');

        if (count(array_diff($clientIdentifiers, $clientsInDb)) !== 0) {
            return false;
        }

        foreach ($data as $user => $client) {
            $userClientModel = new UserClientsModel();
            $userClientModel->user_id = $user;
            $userClientModel->client_id = $client;
            $userClientModel->save();
        }

        return true;
    }

    /**
     * @param  string $userIdentifier
     * @param  string $client |null
     */
    public function removeUserClient($userIdentifier, $client = null)
    {
        $condition = ['user_id' => $userIdentifier];
        if ($client) {
            $condition['client_id'] = $client;
        }
        $clients = UserClientsModel::findAll($condition);

        foreach ($clients as $client) {
            $client->delete();
        }
    }

    /**
     * case:
     *
     * $data = [
     *     'UserIdentifier1' => 'grantIdentifier1',
     *     'UserIdentifier2' => 'grantIdentifier2'
     * ]
     *
     * @param  array $data
     * @return boolean
     */
    public function bindUserGrant(array $data)
    {
        $grantIdentifiers = array_values($data);

        $grantsInDb = ArrayHelper::getColumn(GrantsModel::findByGrantId($grantIdentifiers)->all(), 'id');

        if (count(array_diff($grantIdentifiers, $grantsInDb)) !== 0) {
            return false;
        }

        foreach ($data as $user => $grant) {
            $userGrantsModel = new UserGrantsModel();
            $userGrantsModel->user_id = $user;
            $userGrantsModel->grant_id = $grant;
            $userGrantsModel->save();
        }

        return true;
    }

    /**
     * @param  string $userIdentifier
     * @param  string $grant |null
     */
    public function removeUserGrant($userIdentifier, $grant = null)
    {
        $condition = ['user_id' => $userIdentifier];
        if ($grant) {
            $condition['grant_id'] = $grant;
        }
        $grants = UserGrantsModel::findAll($condition);

        foreach ($grants as $grant) {
            $grant->delete();
        }
    }

    /**
     * case:
     *
     * $data = [
     *     'UserIdentifier1' => 'scopeIdentifier1',
     *     'UserIdentifier2' => 'scopeIdentifier2'
     * ]
     *
     * @param  array $data
     * @return boolean
     */
    public function bindUserScope(array $data)
    {
        $scopeIdentifiers = array_values($data);

        $scopesInDb = ArrayHelper::getColumn(ScopesModel::findByGrantId($scopeIdentifiers)->all(), 'id');

        if (count(array_diff($scopeIdentifiers, $scopesInDb)) !== 0) {
            return false;
        }

        foreach ($data as $user => $sope) {
            $userScopesModel = new UserScopesModel();
            $userScopesModel->user_id = $user;
            $userScopesModel->scope_id = $sope;
            $userScopesModel->save();
        }

        return true;
    }

    /**
     * @param  string $userIdentifier
     * @param  string $scope |null
     */
    public function removeUserScope($userIdentifier, $scope = null)
    {
        $condition = ['user_id' => $userIdentifier];
        if ($scope) {
            $condition['scope_id'] = $scope;
        }
        $scopes = UserScopesModel::findAll($condition);

        foreach ($scopes as $scope) {
            $scope->delete();
        }
    }

}