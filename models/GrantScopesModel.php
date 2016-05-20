<?php

/**
 * @author mylampblog@163.com
 */

namespace pfdtk\oauth2\models;

use Yii;
use yii\db\ActiveQuery;

class GrantScopesModel extends CommonModel
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{%oauth_grant_scopes}}';
    }

    /**
     * @param $grantId
     * @param ActiveQuery|null $query
     * @return ActiveQuery
     */
    public static function findByGrantId($grantId, ActiveQuery $query = null)
    {
        $query = $query ?: static::find();
        return $query->andWhere(['grant_id' => $grantId]);
    }

}