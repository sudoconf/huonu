<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "taobao_zs_advertiser_campaign_rtrpts_total_list".
 *
 * @property string $taobao_user_id 淘宝用户id
 * @property string $campaign_id 计划id
 * @property string $campaign_name 计划名称
 * @property string $charge 花费
 * @property string $log_date 日期
 * @property string $ecpc ecpc
 * @property string $ad_pv 展现量
 * @property string $click 点击量
 * @property string $ecpm ecpm
 * @property string $ctr ctr
 * @property string $last_update_time
 */
class TaobaoZsAdvertiserCampaignRtrptsTotalList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'taobao_zs_advertiser_campaign_rtrpts_total_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['taobao_user_id', 'campaign_id', 'log_date'], 'required'],
            [['last_update_time'], 'safe'],
            [['taobao_user_id', 'campaign_id', 'campaign_name', 'charge', 'log_date', 'ecpc', 'ad_pv', 'click', 'ecpm', 'ctr'], 'string', 'max' => 45],
            [['taobao_user_id', 'campaign_id', 'log_date'], 'unique', 'targetAttribute' => ['taobao_user_id', 'campaign_id', 'log_date']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'taobao_user_id' => '淘宝用户id',
            'campaign_id' => '计划id',
            'campaign_name' => '计划名称',
            'charge' => '花费',
            'log_date' => '日期',
            'ecpc' => 'Ecpc',
            'ad_pv' => '展现量',
            'click' => '点击量',
            'ecpm' => 'Ecpm',
            'ctr' => 'Ctr',
            'last_update_time' => '更新时间',
        ];
    }
}
