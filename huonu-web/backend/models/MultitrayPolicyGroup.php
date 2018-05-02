<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%multitray_policy_group}}".
 * @property string $policy_group_id
 * @property string $policy_group_name 策略组名称
 * @property int $multitray_id 复盘id
 * @property int $taobao_id 淘宝用户id
 * @property int $target_id 定向id
 * @property string $target_name 定向名称
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
            [['policy_group_name', 'multitray_id', 'taobao_id', 'target_id', 'target_name'], 'required'],
            [['multitray_id', 'taobao_id', 'target_id'], 'integer'],
            [['policy_group_name'], 'string', 'max' => 20],
            [['target_name'], 'string', 'max' => 150],
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
            'taobao_id' => '淘宝用户id',
            'target_id' => '定向id',
            'target_name' => '定向名称',
        ];
    }
}
