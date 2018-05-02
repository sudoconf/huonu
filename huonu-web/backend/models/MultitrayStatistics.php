<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%multitray_statistics}}".
 *
 * @property string $id
 * @property int $multitray_id 复盘id
 * @property string $multitray_statistics_content_json 统计数据(以 json 格式存储)
 */
class MultitrayStatistics extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%multitray_statistics}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['multitray_id', 'multitray_statistics_content_json'], 'required'],
            [['multitray_id'], 'integer'],
            [['multitray_statistics_content_json'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'multitray_id' => '复盘id',
            'multitray_statistics_content_json' => '统计数据',
        ];
    }
}
