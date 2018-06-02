<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "taobao_zs_adgroup_adzone_list".
 *
 * @property int $adgroup_id 计划id
 * @property int $campaign_id 单元id
 * @property int $crowd_id 定向id
 * @property int $adzone_id 广告位id
 * @property string $taobao_user_id 淘宝卖家id
 * @property int $allow_adv_type 允许的广告主类型
 * @property int $adzone_level 广告位等级
 * @property int $media_type 媒体类型
 * @property string $adzone_name 广告位名称
 * @property string $adzone_size_list 广告位尺寸列表
 * @property string $allow_ad_format_list 允许的创意类型列表
 * @property int $crowd_type 定向类型
 * @property double $price 出价
 * @property string $last_update_time 最后一次更新时间
 */
class TaobaoZsAdgroupAdzoneList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'taobao_zs_adgroup_adzone_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['adgroup_id', 'campaign_id', 'crowd_id', 'adzone_id', 'taobao_user_id'], 'required'],
            [['adgroup_id', 'campaign_id', 'crowd_id', 'adzone_id', 'allow_adv_type', 'adzone_level', 'media_type', 'crowd_type'], 'integer'],
            [['price'], 'number'],
            [['last_update_time'], 'safe'],
            [['taobao_user_id', 'adzone_name', 'adzone_size_list', 'allow_ad_format_list'], 'string', 'max' => 255],
            [['adgroup_id', 'campaign_id', 'crowd_id', 'adzone_id', 'taobao_user_id'], 'unique', 'targetAttribute' => ['adgroup_id', 'campaign_id', 'crowd_id', 'adzone_id', 'taobao_user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'adgroup_id' => 'Adgroup ID',
            'campaign_id' => 'Campaign ID',
            'crowd_id' => 'Crowd ID',
            'adzone_id' => 'Adzone ID',
            'taobao_user_id' => 'Taobao User ID',
            'allow_adv_type' => 'Allow Adv Type',
            'adzone_level' => 'Adzone Level',
            'media_type' => 'Media Type',
            'adzone_name' => 'Adzone Name',
            'adzone_size_list' => 'Adzone Size List',
            'allow_ad_format_list' => 'Allow Ad Format List',
            'crowd_type' => 'Crowd Type',
            'price' => 'Price',
            'last_update_time' => 'Last Update Time',
        ];
    }
}
