<?php
/**
 * Created by prtens.
 * User: hx
 * Date: 2018/4/8 14:56
 */

namespace backend\models;

use Yii;

class BaseModel extends \yii\db\ActiveRecord{

    public function behaviors()
    {
        return [
            // TimestampBehavior::className(),
            // UpdateBehavior::className(),
        ];
    }
}