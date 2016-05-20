<?php

/**
 * @author mylampblog@163.com
 */

namespace pfdtk\oauth2\models;

use Yii;
use yii\db\ActiveQuery;

class AccessTokenScopesModel extends CommonModel
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{%oauth_access_token_scopes}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['access_token_id', 'scope_id'], 'required'],
            [['access_token_id'], 'string', 'max' => 255],
            [['scope_id'], 'string', 'max' => 40],
        ];
    }

}