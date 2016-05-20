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
        foreach ($scopes as $key => $item) {
            $query = ScopesModel::findByScopeId($item->getIdentifier());
            ScopesModel::findByGrantId($grantType, $query);
            ScopesModel::findByClientId($clientEntity->getIdentifier(), $query);
            if ($userIdentifier) {
                ScopesModel::findByUserId($userIdentifier, $query);
            }
            if (!$query->one()) unset($scopes[$key]);
        }
        return $scopes;
    }
}