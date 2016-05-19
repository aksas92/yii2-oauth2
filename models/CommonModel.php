<?php

/**
 * @author mylampblog@163.com
 */

namespace pfdtk\oauth2\models;

use Yii;
use yii\db\ActiveRecord;
use pfdtk\oauth2\config\ConfigInterface;

class CommonModel extends ActiveRecord
{
    /**
     * @return object|\yii\db\Connection
     */
    public static function getDb()
    {
        $db = Yii::$container->get(ConfigInterface::class)->get('db');
        return Yii::$app->get($db);
    }

}