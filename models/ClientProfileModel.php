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
     * @return ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(ClientModel::className(), ['id' => 'client_id']);
    }

}