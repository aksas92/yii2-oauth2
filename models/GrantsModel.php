<?php

/**
 * @author mylampblog@163.com
 */

namespace pfdtk\oauth2\models;

use Yii;
use yii\db\ActiveQuery;

class GrantsModel extends CommonModel
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{%oauth_grants}}';
    }

    /**
     * @return ActiveQuery
     */
    public function getClientGrants()
    {
        return $this->hasMany(ClientGrantsModel::className(), ['grant_id' => 'id']);
    }

    /**
     * @param $grantType
     * @param ActiveQuery|null $query
     * @return ActiveQuery
     */
    public static function findByGrantId($grantType, ActiveQuery $query = null)
    {
        $query = $query ?: static::find();
        return $query->andWhere(['id' => $grantType]);
    }

}