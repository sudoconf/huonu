<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "taobao_zs_advertiser_adzone_rtrpts_total_list".
 *
 * @property string $taobao_user_id 淘宝用户id
 * @property string $campaign_id 计划id
 * @property string $adgroup_id 单元id
 * @property string $adzone_id 资源位id
 * @property string $charge 消耗
 * @property string $log_date 投放日期
 * @property string $ecpc 平均点击单价
 * @property string $ad_pv 展现量
 * @property string $click 点击量
 * @property string $ecpm 平均千次展现成本
 * @property string $ctr 点击率
 * @property string $adgroup_name 单元名称
 * @property string $campaign_name 计划名称
 * @property string $last_update_time 最后更新时间
 * @property string $adzone_name 资源位名称
 */
class TaobaoZsAdvertiserAdzoneRtrptsTotalList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'taobao_zs_advertiser_adzone_rtrpts_total_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['taobao_user_id', 'campaign_id', 'adgroup_id', 'adzone_id', 'log_date'], 'required'],
            [['last_update_time'], 'safe'],
            [['taobao_user_id', 'campaign_id', 'adgroup_id', 'adzone_id', 'charge', 'log_date', 'ecpc', 'ad_pv', 'click', 'ecpm', 'ctr', 'adgroup_name', 'campaign_name', 'adzone_name'], 'string', 'max' => 45],
            [['taobao_user_id', 'campaign_id', 'adgroup_id', 'adzone_id', 'log_date'], 'unique', 'targetAttribute' => ['taobao_user_id', 'campaign_id', 'adgroup_id', 'adzone_id', 'log_date']],
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
            'adzone_id' => 'Adzone ID',
            'charge' => 'Charge',
            'log_date' => 'Log Date',
            'ecpc' => 'Ecpc',
            'ad_pv' => 'Ad Pv',
            'click' => 'Click',
            'ecpm' => 'Ecpm',
            'ctr' => 'Ctr',
            'adgroup_name' => 'Adgroup Name',
            'campaign_name' => 'Campaign Name',
            'last_update_time' => 'Last Update Time',
            'adzone_name' => 'Adzone Name',
        ];
    }
}
