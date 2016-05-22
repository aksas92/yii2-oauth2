<?php

/**
 * @author mylampblog@163.com
 */

namespace pfdtk\oauth2\repository;
use pfdtk\oauth2\models\GrantsModel;

class GrantRepository
{
    /**
     * @var array
     */
    static $grants = [];

    /**
     * initGrant
     */
    public function initGrant()
    {
        
    }

    /**
     * case:
     *
     * $data = [
     *     'grantIdentifier1' => 'scopeIdentifier1',
     *     'grantIdentifier2' => 'scopeIdentifier2'
     * ]
     * 
     * @param  array $data
     */
    public function bindGrantScope(array $data)
    {

    }

    /**
     * @param  string $identifier
     * @param  string $scope|null
     */
    public function removeGrantScope($identifier, $scope = null)
    {

    }


}