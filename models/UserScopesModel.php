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
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'scope_id'], 'required'],
            [['user_id'], 'string', 'max' => 255],
            [['scope_id'], 'string', 'max' => 40],
            [['user_id', 'scope_id'], 'unique', 'targetAttribute' => ['user_id', 'scope_id'], 'message' => 'The combination of User ID and Scope ID has already been taken.'],
        ];
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