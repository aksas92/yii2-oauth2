<?php

/**
 * @author mylampblog@163.com
 */

namespace pfdtk\oauth2\models;

use Yii;
use yii\db\ActiveQuery;

class AuthCodeScopesModel extends CommonModel
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{%oauth_auth_code_scopes}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['auth_code_id', 'scope_id'], 'required'],
            [['auth_code_id'], 'string', 'max' => 255],
            [['scope_id'], 'string', 'max' => 40],
        ];
    }

}