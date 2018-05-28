<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%user_time_template}}".
 *
 * @property string $time_template_id
 * @property string $taobao_user_id 淘宝用户id
 * @property string $time_template_name 投放时间段模板名称
 * @property string $time_template_workday 周一-周五投放时间段
 * @property string $time_template_weekend 周末投放时间段
 */
class UserTimeTemplate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_time_template}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['taobao_user_id'], 'integer'],
            [['taobao_user_id', 'time_template_name', 'time_template_workday', 'time_template_weekend'], 'required'],
            [['taobao_user_id', 'time_template_name', 'time_template_workday', 'time_template_weekend'], 'string', 'max' => 255],

            ['time_template_name', 'trim'],
            [['time_template_name'], 'unique', 'targetClass' => '\backend\models\UserTimeTemplate', 'message' => '已存在同名模板.'],
            ['time_template_name', 'string', 'min' => 2, 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'time_template_id' => 'ID',
            'taobao_user_id' => '淘宝用户id',
            'time_template_name' => '投放时间段模板名称',
            'time_template_workday' => '周一-周五投放时间段',
            'time_template_weekend' => '周末投放时间段',
        ];
    }
}
