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
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'secret', 'name'], 'required'],
            [['id', 'secret'], 'string', 'max' => 40],
            [['name'], 'string', 'max' => 255],
            [['id', 'secret'], 'unique', 'targetAttribute' => ['id', 'secret'], 'message' => 'The combination of ID and Secret has already been taken.'],
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getClientGrants()
    {
        return $this->hasMany(ClientGrantsModel::className(), ['client_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getClientProfile()
    {
        return $this->hasOne(ClientProfileModel::className(), ['client_id' => 'id']);
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