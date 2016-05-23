<?php

/**
 * @author mylampblog@163.com
 */

namespace pfdtk\oauth2\models;

use Yii;
use yii\db\ActiveQuery;

class ClientGrantsModel extends CommonModel
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{%oauth_client_grants}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_id', 'grant_id'], 'required'],
            [['client_id', 'grant_id'], 'string', 'max' => 40],
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(ClientModel::className(), ['id' => 'client_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getGrant()
    {
        return $this->hasOne(GrantsModel::className(), ['id' => 'grant_id']);
    }

    /**
     * @param $grantType
     * @param ActiveQuery|null $query
     * @return ActiveQuery
     */
    public static function findByGrantType($grantType, ActiveQuery $query = null)
    {
        $query = $query ?: static::find();
        return $query->andWhere(['grant_id' => $grantType])->andWhere(['grant_id' => GrantsModel::findByGrantId($grantType)->select(['id'])]);
    }

}