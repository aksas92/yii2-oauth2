<?php

namespace pfdtk\oauth2\models\behaviors;

use yii\db\ActiveRecord;
use yii\base\Behavior;
use pfdtk\oauth2\models\CommonModel;

class TransactionBehavior extends Behavior
{
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeTransaction',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeTransaction',
            ActiveRecord::EVENT_BEFORE_DELETE => 'beforeTransaction',
            ActiveRecord::EVENT_AFTER_INSERT => 'afterTransaction',
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterTransaction',
            ActiveRecord::EVENT_AFTER_DELETE => 'afterTransaction',
        ];
    }

    public function beforeTransaction()
    {
        $db = CommonModel::getDb();
        $db->beginTransaction();
    }

    public function afterTransaction()
    {
        $db = CommonModel::getDb();
        $db->getTransaction()->commit();
    }
}