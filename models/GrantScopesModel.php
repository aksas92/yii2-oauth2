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
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['grant_id', 'scope_id'], 'required'],
            [['grant_id', 'scope_id'], 'string', 'max' => 40],
        ];
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