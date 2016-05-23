<?php

/**
 * @author mylampblog@163.com
 */

namespace pfdtk\oauth2\repository;

use pfdtk\oauth2\models\GrantsModel;

class GrantRepository
{
    /**
     * @var string
     */
    const GRANT_AUTHORIZATIOIN_CODE = 'authorization_code';
    const GRANT_CREDENTIALS_CODE = 'client_credentials';
    const GRANT_IMPLICIT = 'implicit';
    const GRANT_PASSWORD = 'password';
    const GRANT_REFRESH_TOKEN = 'refresh_token';

    /**
     * @var array
     */
    static $grants = [
        self::GRANT_AUTHORIZATIOIN_CODE,
        self::GRANT_CREDENTIALS_CODE,
        self::GRANT_IMPLICIT,
        self::GRANT_PASSWORD,
        self::GRANT_REFRESH_TOKEN
    ];

    /**
     * initGrant
     */
    public function initGrant()
    {
        foreach (self::$grants as $item) {
            $model = new GrantsModel();
            $model->id = $item;
            $model->save();
        }
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
     * @param  string $scope |null
     */
    public function removeGrantScope($identifier, $scope = null)
    {

    }


}