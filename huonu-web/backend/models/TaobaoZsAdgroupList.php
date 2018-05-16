<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "taobao_zs_adgroup_list".
 *
 * @property string $taobao_user_id
 * @property int $campaign_id 计划ID
 * @property int $online_status 单元id，1投放中9结束投放
 * @property int $adgroup_id 单元ID
 * @property string $adgroup_name 单元名称
 * @property string $last_update_time
 */
class TaobaoZsAdgroupList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'taobao_zs_adgroup_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['taobao_user_id', 'campaign_id', 'adgroup_id'], 'required'],
            [['campaign_id', 'online_status', 'adgroup_id'], 'integer'],
            [['last_update_time'], 'safe'],
            [['taobao_user_id', 'adgroup_name'], 'string', 'max' => 45],
            [['taobao_user_id', 'campaign_id', 'adgroup_id'], 'unique', 'targetAttribute' => ['taobao_user_id', 'campaign_id', 'adgroup_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'taobao_user_id' => 'Taobao User ID',
            'campaign_id' => 'Campaign ID',
            'online_status' => 'Online Status',
            'adgroup_id' => 'Adgroup ID',
            'adgroup_name' => 'Adgroup Name',
            'last_update_time' => 'Last Update Time',
        ];
    }
}
