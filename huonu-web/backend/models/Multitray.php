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
 * @property string $multitray_effect_model 效果模型 click(点击效果) impression(展示效果)
 * @property int $multitray_cycle 数据周期 3、7、15 天
 * @property string $multitray_field 字段 json格式
 * @property int $is_delete 是否删除
 * @property int $created_at 添加时间
 * @property int $updated_at 修改时间
 */
class Multitray extends \yii\db\ActiveRecord
{
    public static $multitrayField = [
        'charge' => '消耗',
        'ad_pv' => '展现量',
        'click' => '点击量',
        'uv' => '访客',
        'deep_inshop_uv' => '深度进店',
        'avg_access_time' => '访问时长',
        'avg_access_page_num' => '访问页面数',
        'inshop_item_col_num' => '收藏宝贝量',
        'dir_shop_col_num' => '收藏店铺量',
        'cart_num' => '添加购物车量',
        'gmv_inshop_num' => '拍下订单量',
        'gmv_inshop_amt' => '拍下订单金额',
        'commodity_collection_rate' => '商品收藏率',
        'purchase_rate_of_goods' => '商品加购率',
        'commodity_collection_cost' => '商品收藏成本',
        'purchase_cost_of_goods' => '商品加购成本',
        'purchase_cost_of_goods_collection' => '商品收藏加购成本',
        'alipay_in_shop_num' => '成交订单量',
        'alipay_inshop_amt' => '成交订单金额',
        'average_cost_of_order' => '订单平均成本',
        'order_average_amount' => '订单平均金额',
        'ecpm' => '千次展现成本',
        'ctr' => '点击率',
        'ecpc' => '点击单价',
        'cvr' => '点击转化率',
        'roi' => '投资回报率',
    ];

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
            [['taobao_id', 'taobao_name', 'multitray_name', 'multitray_start_time', 'multitray_end_time', 'multitray_effect_model', 'multitray_cycle', 'multitray_field'], 'required'],
            [['multitray_start_time', 'multitray_end_time', 'created_at', 'updated_at'], 'integer'],
            [['taobao_id'], 'string', 'max' => 20],
            [['taobao_name'], 'string', 'max' => 30],
            [['multitray_name'], 'string', 'max' => 50],
            [['multitray_effect_model'], 'string', 'max' => 15],
            [['multitray_field'], 'string', 'max' => 150],
            [['is_delete'], 'default', 'value' => 0], // 添加默认值
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
            'is_delete' => '删除',
            'created_at' => '添加时间',
            'updated_at' => '修改时间',
        ];
    }

    /**
     * @param string $field
     * @return mixed
     */
    public static function getMultitrayField($field = 'charge')
    {
        if (array_key_exists($field, self::$multitrayField)) {
            return self::$multitrayField[$field];
        }
    }
}
