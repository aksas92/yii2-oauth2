<?php

/**
 * @author mylampblog@163.com
 */

namespace pfdtk\oauth2\models;

use Yii;
use yii\db\ActiveQuery;

class RefreshTokensModel extends CommonModel
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{%oauth_refresh_tokens}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'access_token_id', 'expire_time'], 'required'],
            [['expire_time'], 'integer'],
            [['id', 'access_token_id'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

}