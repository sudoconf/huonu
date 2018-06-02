<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "taobao_zs_advertiser_adgroup_rtrpts_total_list".
 *
 * @property string $taobao_user_id
 * @property string $campaign_id 计划id
 * @property string $adgroup_id 单元id
 * @property string $campaign_name 计划名
 * @property string $adgroup_name 单元名
 * @property string $charge 花费
 * @property string $log_date 日期
 * @property string $ecpc ecpc
 * @property string $ad_pv 展现量
 * @property string $click 点击量
 * @property string $ecpm ecpm
 * @property string $ctr ctr
 * @property string $last_update_time
 */
class TaobaoZsAdvertiserAdgroupRtrptsTotalList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'taobao_zs_advertiser_adgroup_rtrpts_total_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['taobao_user_id', 'campaign_id', 'adgroup_id', 'log_date'], 'required'],
            [['last_update_time'], 'safe'],
            [['taobao_user_id', 'campaign_id', 'adgroup_id', 'campaign_name', 'adgroup_name', 'charge', 'log_date', 'ecpc', 'ad_pv', 'click', 'ecpm', 'ctr'], 'string', 'max' => 45],
            [['taobao_user_id', 'campaign_id', 'adgroup_id', 'log_date'], 'unique', 'targetAttribute' => ['taobao_user_id', 'campaign_id', 'adgroup_id', 'log_date']],
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
            'adgroup_id' => 'Adgroup ID',
            'campaign_name' => 'Campaign Name',
            'adgroup_name' => 'Adgroup Name',
            'charge' => 'Charge',
            'log_date' => 'Log Date',
            'ecpc' => 'Ecpc',
            'ad_pv' => 'Ad Pv',
            'click' => 'Click',
            'ecpm' => 'Ecpm',
            'ctr' => 'Ctr',
            'last_update_time' => 'Last Update Time',
        ];
    }
}
