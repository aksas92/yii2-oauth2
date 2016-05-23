<?php

/**
 * @author mylampblog@163.com
 */

namespace pfdtk\oauth2\models;

use Yii;
use yii\db\ActiveQuery;

class ClientProfileModel extends CommonModel
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{%oauth_client_profile}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_id', 'redirect_uri'], 'required'],
            [['client_id'], 'string', 'max' => 40],
            [['redirect_uri'], 'string', 'max' => 255],
            [['client_id', 'redirect_uri'], 'unique', 'targetAttribute' => ['client_id', 'redirect_uri'], 'message' => 'The combination of Client ID and Redirect Uri has already been taken.'],
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(ClientModel::className(), ['id' => 'client_id']);
    }

}