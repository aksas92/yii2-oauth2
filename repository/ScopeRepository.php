<?php

/**
 * @author mylampblog@163.com
 */

namespace pfdtk\oauth2\repository;

use League\OAuth2\Server\Repositories\ScopeRepositoryInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use pfdtk\oauth2\models\ScopesModel;
use pfdtk\oauth2\entities\ScopeEntity;

class ScopeRepository implements ScopeRepositoryInterface
{
    /**
     * @param string $identifier
     * @return \League\OAuth2\Server\Entities\ScopeEntityInterface
     */
    public function getScopeEntityByIdentifier($identifier)
    {
        if (!$result = ScopesModel::findByScopeId($identifier)->one()) {
            return false;
        }
        $scopeEntity = new ScopeEntity();
        $scopeEntity->setIdentifier($result->id);
        return $scopeEntity;
    }

    /**
     * @param \League\OAuth2\Server\Entities\ScopeEntityInterface[] $scopes
     * @param string $grantType
     * @param ClientEntityInterface $clientEntity
     * @param null $userIdentifier|string
     * @return \League\OAuth2\Server\Entities\ScopeEntityInterface[]
     */
    public function finalizeScopes(array $scopes, $grantType, ClientEntityInterface $clientEntity, $userIdentifier = null)
    {
        $scopesId = [];
        foreach ($scopes as $item) {
            $scopesId[] = $item->getIdentifier();
        }

        $query = ScopesModel::findByScopeId($scopesId);
        ScopesModel::findByGrantId($grantType, $query);
        ScopesModel::findByClientId($clientEntity->getIdentifier(), $query);

        if ($userIdentifier) {
            ScopesModel::findByUserId($userIdentifier, $query);
        }

        $result = $query->all();

        $entitys = [];
        foreach ($result as $item) {
            foreach ($scopes as $key => $scope) {
                if ($item->id == $scope->getIdentifier()) $entitys[$key] = $scope;
            }
        }
        
        return $entitys;
    }

    /**
     * {@inheritdoc}
     */
    public function addNewScope($scopeId, $description)
    {
        $scope = new ScopesModel();
        $scope->id = $scopeId;
        $scope->description = $description;
        if ($scope->save()) {
            $scopeEntity = new ScopeEntity();
            $scopeEntity->setIdentifier($scopeId);
            return $scopeEntity;
        }
        return false;
    }


}