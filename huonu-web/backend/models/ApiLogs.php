<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%api_logs}}".
 *
 * @property int $id
 * @property string $api_name api 名称
 * @property string $created_at 调用时间
 * @property string $call_people 调用人
 */
class ApiLogs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%api_logs}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['api_name', 'created_at', 'call_people'], 'required'],
            [['created_at'], 'safe'],
            [['api_name', 'call_people'], 'string', 'max' => 255],
        ];
    }

    /**
     * 设置自定义属性
     * @return array
     */
    public function attributes()
    {
        $parent = parent::attributes();

        $attributes = [
            'callNumber',
        ];
        return array_merge($parent, $attributes);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'api_name' => 'api 名称',
            'created_at' => '调用时间',
            'call_people' => '调用人',
        ];
    }
}
