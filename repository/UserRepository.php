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
}