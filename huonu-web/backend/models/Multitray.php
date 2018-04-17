<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%multitray}}".
 *
 * @property string $multitray_id
 * @property string $taobao_id 淘宝id
 * @property string $taobao_name 淘宝账号名称
 * @property string $multitray_name 复盘名称
 * @property int $multitray_start_time 起始时间
 * @property int $multitray_end_time 截止时间
 * @property string $multitray_effect_model 效果模型 click_effect(点击效果) show_effect(展示效果)
 * @property int $multitray_cycle 数据周期 3、7、15 天
 * @property string $multitray_field 字段 json格式
 * @property int $created_at 添加时间
 * @property int $updated_at 修改时间
 */
class Multitray extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%multitray}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['taobao_id', 'taobao_name', 'multitray_name', 'multitray_start_time', 'multitray_end_time', 'multitray_effect_model', 'multitray_cycle', 'multitray_field', 'created_at', 'updated_at'], 'required'],
            [['multitray_start_time', 'multitray_end_time', 'created_at', 'updated_at'], 'integer'],
            [['taobao_id'], 'string', 'max' => 20],
            [['taobao_name'], 'string', 'max' => 30],
            [['multitray_name'], 'string', 'max' => 50],
            [['multitray_effect_model'], 'string', 'max' => 15],
            [['multitray_cycle'], 'string', 'max' => 1],
            [['multitray_field'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'multitray_id' => 'ID',
            'taobao_id' => '淘宝id',
            'taobao_name' => '淘宝账号名称',
            'multitray_name' => '复盘名称',
            'multitray_start_time' => '起始时间',
            'multitray_end_time' => '截止时间',
            'multitray_effect_model' => '效果模型',
            'multitray_cycle' => '数据周期',
            'multitray_field' => '字段',
            'created_at' => '添加时间',
            'updated_at' => '修改时间',
        ];
    }
}
