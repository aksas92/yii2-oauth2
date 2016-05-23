<?php

/**
 * @author mylampblog@163.com
 */

namespace pfdtk\oauth2\models;

use Yii;
use yii\db\ActiveRecord;
use pfdtk\oauth2\config\ConfigInterface;
use yii\behaviors\TimestampBehavior;
use pfdtk\oauth2\models\behaviors\TransactionBehavior;

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

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            TransactionBehavior::className(),
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

}