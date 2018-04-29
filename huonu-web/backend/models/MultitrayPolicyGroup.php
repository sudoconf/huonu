<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%multitray_policy_group}}".
 *
 * @property string $policy_group_id
 * @property int $multitray_id 复盘id
 * @property string $policy_group_name 策略组名称
 * @property string $policy_group_target_json 定向json 数据
 (
     target_id 定向id
     target_name 定向名称
 )
 */
class MultitrayPolicyGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%multitray_policy_group}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['multitray_id', 'policy_group_name', 'policy_group_target_json'], 'required'],
            [['multitray_id'], 'integer'],
            [['policy_group_target_json'], 'string'],
            [['policy_group_name'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'policy_group_id' => 'ID',
            'multitray_id' => '复盘ID',
            'policy_group_name' => '策略组名称',
            'policy_group_target_json' => '策略组json数据',
        ];
    }
}
