<?php

/**
 * @author mylampblog@163.com
 */

namespace pfdtk\oauth2\models;

use Yii;
use yii\db\ActiveQuery;

class UserScopesModel extends CommonModel
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{%oauth_user_scopes}}';
    }

    /**
     * @param $userId
     * @param ActiveQuery|null $query
     * @return ActiveQuery
     */
    public static function findByUserId($userId, ActiveQuery $query = null)
    {
        $query = $query ?: static::find();
        return $query->andWhere(['user_id' => $userId]);
    }

}