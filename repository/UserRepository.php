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
use pfdtk\oauth2\models\UserClientsModel;

class UserRepository implements UserRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function getUserEntityByUserCredentials($username, $password, $grantType, ClientEntityInterface $clientEntity)
    {
    	$container = Yii::$container;
        $userEntity = $container->get(UserInterface::class)->checkUserCredentials($username, $password);
        if($userEntity instanceof UserEntity === false) {
        	return false;
        }

        $checkGrant = UserGrantsModel::findByUserId($userEntity->getIdentifier())->one();
        $checkClient = UserClientsModel::findByUserId($userEntity->getIdentifier())->one();
        if(!$checkClient or !$checkGrant) {
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
     */
    public function bindUserClient(array $data)
    {

    }

    /**
     * @param  string $identifier
     * @param  string $client|null
     */
    public function removeUserClient($identifier, $client = null)
    {

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
     */
    public function bindUserGrant(array $data)
    {

    }

    /**
     * @param  string $identifier
     * @param  string $grant|null
     */
    public function removeUserGrant($identifier, $grant = null)
    {

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
     */
    public function bindUserScope(array $data)
    {

    }

    /**
     * @param  string $identifier
     * @param  string $scope|null
     */
    public function removeUserScope($identifier, $scope = null)
    {

    }

}