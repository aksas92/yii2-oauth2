<?php

/**
 * @author mylampblog@163.com
 */

namespace pfdtk\oauth2\models;

use Yii;
use yii\db\ActiveQuery;

class AuthCodesModel extends CommonModel
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{%oauth_auth_codes}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'client_id', 'expire_time'], 'required'],
            [['expire_time'], 'integer'],
            [['id', 'user_id'], 'string', 'max' => 255],
            [['client_id'], 'string', 'max' => 40],
        ];
    }

}