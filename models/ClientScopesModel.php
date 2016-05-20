<?php

/**
 * @author mylampblog@163.com
 */

namespace pfdtk\oauth2\models;

use Yii;
use yii\db\ActiveQuery;

class ClientScopesModel extends CommonModel
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{%oauth_client_scopes}}';
    }

    /**
     * @param $clientId
     * @param ActiveQuery|null $query
     * @return ActiveQuery
     */
    public static function findByClientId($clientId, ActiveQuery $query = null)
    {
        $query = $query ?: static::find();
        return $query->andWhere(['client_id' => $clientId]);
    }

}