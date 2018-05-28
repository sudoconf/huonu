<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%zs_adzone_condition}}".
 *
 * @property string $condition_id
 * @property string $condition_name 条件名称
 * @property string $condition_field_name 条件字段名称
 * @property string $condition_value 条件字段值
 * @property int $parent_id 父类Id
 */
class ZsAdzoneCondition extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%zs_adzone_condition}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['condition_name', 'condition_field_name', 'condition_value', 'parent_id'], 'required'],
            [['parent_id'], 'integer'],
            [['condition_name'], 'string', 'max' => 20],
            [['condition_field_name', 'condition_value'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'condition_id' => 'ID',
            'condition_name' => '条件名称',
            'condition_field_name' => '条件字段名称',
            'condition_value' => '条件字段值',
            'parent_id' => '父类Id',
        ];
    }
}
