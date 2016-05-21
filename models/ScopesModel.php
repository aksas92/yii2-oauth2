<?php

/**
 * @author mylampblog@163.com
 */

namespace pfdtk\oauth2\models;

use Yii;
use yii\db\ActiveQuery;

class ScopesModel extends CommonModel
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{%oauth_scopes}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'description'], 'required'],
            [['id'], 'string', 'max' => 40],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @param $identifier
     * @param ActiveQuery|null $query
     * @return ActiveQuery
     */
    public static function findByScopeId($identifier, ActiveQuery $query = null)
    {
        $query = $query ?: static::find();
        return $query->andWhere(['id' => $identifier]);
    }

    /**
     * @param $grantId
     * @param ActiveQuery|null $query
     * @return ActiveQuery
     */
    public static function findByGrantId($grantId, ActiveQuery $query = null)
    {
        $query = $query ?: static::find();
        return $query->andWhere(['id' => GrantScopesModel::findByGrantId($grantId)->select(['scope_id'])]);
    }

    /**
     * @param $clientId
     * @param ActiveQuery|null $query
     * @return ActiveQuery
     */
    public static function findByClientId($clientId, ActiveQuery $query = null)
    {
        $query = $query ?: static::find();
        return $query->andWhere(['id' => ClientScopesModel::findByClientId($clientId)->select(['scope_id'])]);
    }

    /**
     * @param $userId
     * @param ActiveQuery|null $query
     * @return ActiveQuery
     */
    public static function findByUserId($userId, ActiveQuery $query = null)
    {
        $query = $query ?: static::find();
        return $query->andWhere(['id' => UserScopesModel::findByUserId($userId)->select(['scope_id'])]);
    }

}