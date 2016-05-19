<?php

/**
 * @author mylampblog@163.com
 */

namespace pfdtk\oauth2\models;

use Yii;
use yii\db\ActiveQuery;

class ClientModel extends CommonModel
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{%oauth_clients}}';
    }

    /**
     * @return ActiveQuery
     */
    public function getClientGrants()
    {
        return $this->hasMany(ClientGrantsModel::className(), ['client_id' => 'id']);
    }

    /**
     * @param $clientIdentifier
     * @param ActiveQuery|null $query
     * @return ActiveQuery
     */
    public static function findByClientId($clientIdentifier, ActiveQuery $query = null)
    {
        $query = $query ?: static::find();
        return $query->andWhere(['id' => $clientIdentifier]);
    }

    /**
     * @param $clientSecret
     * @param ActiveQuery|null $query
     * @return ActiveQuery
     */
    public static function findBySecret($clientSecret, ActiveQuery $query = null)
    {
        $query = $query ?: static::find();
        return $query->andWhere(['secret' => $clientSecret]);
    }

    /**
     * @param $grantType
     * @param ActiveQuery|null $query
     * @return ActiveQuery
     */
    public static function findByGrantType($grantType, ActiveQuery $query = null)
    {
        $query = $query ?: static::find();
        return $query->andWhere(['id' => ClientGrantsModel::findByGrantType($grantType)->select(['client_id'])]);
    }

}