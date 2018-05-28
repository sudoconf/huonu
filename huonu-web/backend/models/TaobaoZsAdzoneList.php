<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "taobao_zs_adzone_list".
 *
 * @property string $taobao_user_id 淘宝用户id
 * @property int $adzone_id 广告位id
 * @property string $adzone_size_list 广告位尺寸列表
 * @property string $allow_ad_format_list 广告位允许的创意类型列表
 * @property int $allow_adv_type 广告位允许的广告主类型。 -1表示不限，1表示淘宝，2表示天猫，3表示淘宝和天猫
 * @property int $adzone_level 广告位等级
 * @property string $adzone_name 广告位名称
 * @property int $media_type 媒体类型。1表示PC 2表示无线
 * @property string $last_update_time 更新时间
 */
class TaobaoZsAdzoneList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'taobao_zs_adzone_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['taobao_user_id', 'adzone_id', 'adzone_size_list', 'allow_adv_type', 'adzone_level', 'adzone_name', 'media_type'], 'required'],
            [['adzone_id', 'allow_adv_type', 'adzone_level', 'media_type'], 'integer'],
            [['last_update_time'], 'safe'],
            [['taobao_user_id'], 'string', 'max' => 100],
            [['adzone_size_list', 'allow_ad_format_list'], 'string', 'max' => 220],
            [['adzone_name'], 'string', 'max' => 45],
            [['taobao_user_id', 'adzone_id', 'adzone_size_list'], 'unique', 'targetAttribute' => ['taobao_user_id', 'adzone_id', 'adzone_size_list']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'taobao_user_id' => '淘宝用户id',
            'adzone_id' => '广告位id',
            'adzone_size_list' => '广告位尺寸列表',
            'allow_ad_format_list' => '广告位允许的创意类型列表',
            'allow_adv_type' => '广告位允许的广告主类型',
            'adzone_level' => '广告位等级',
            'adzone_name' => '广告位名称',
            'media_type' => '媒体类型',
            'last_update_time' => '更新时间',
        ];
    }
}
