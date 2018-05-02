<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "taobao_zs_advertiser_target_day_sum_list".
 *
 * @property string $target_id
 * @property string $target_name 定向名称
 * @property string $taobao_user_id 淘宝用户id
 * @property double $cvr 点击转化率
 * @property double $alipay_inshop_amt 成交额
 * @property double $alipay_in_shop_num 成交量
 * @property double $gmv_inshop_amt gmv成交额
 * @property double $gmv_inshop_num gmv成交量
 * @property double $cart_num 加购物车数
 * @property double $dir_shop_col_num 店铺收藏数
 * @property double $inshop_item_col_num 宝贝收藏数
 * @property double $avg_access_page_num 平均访问页面数
 * @property double $avg_access_time 平均访问时长
 * @property double $deep_inshop_uv 深度进店uv
 * @property double $uv 访客量
 * @property double $ecpm 前次展现成本
 * @property double $ecpc 点击单价
 * @property double $ctr 点击率
 * @property double $charge 花费
 * @property double $click 点击量
 * @property double $ad_pv 展现量
 * @property double $roi 消耗产出比
 * @property double $item_cart_rate 商铺加购率
 * @property double $item_col_rate 商品收藏率
 * @property double $item_cart_price 商品加购成本
 * @property double $item_col_price 商品收藏成本
 * @property double $item_cartcol_price 商铺收藏加购成本
 * @property double $alipay_avg_price 订单平均成本
 * @property double $alipay_avg_amt 订单平均金额
 * @property string $log_date 日期
 * @property int $effect 效果周期，取值范围：3,7,15。分别表示效果转化周期-3天/7天/15天。
 * @property string $effect_type 计划类型。1：全店推广；4单品推广。不传则返回全店、单品加和数据
 * @property string $last_update_time 最后更新时间
 */
class TaobaoZsAdvertiserTargetDaySumList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'taobao_zs_advertiser_target_day_sum_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['target_id', 'target_name', 'taobao_user_id', 'log_date', 'effect', 'effect_type'], 'required'],
            [['target_name'], 'string'],
            [['cvr', 'alipay_inshop_amt', 'alipay_in_shop_num', 'gmv_inshop_amt', 'gmv_inshop_num', 'cart_num', 'dir_shop_col_num', 'inshop_item_col_num', 'avg_access_page_num', 'avg_access_time', 'deep_inshop_uv', 'uv', 'ecpm', 'ecpc', 'ctr', 'charge', 'click', 'ad_pv', 'roi', 'item_cart_rate', 'item_col_rate', 'item_cart_price', 'item_col_price', 'item_cartcol_price', 'alipay_avg_price', 'alipay_avg_amt'], 'number'],
            [['effect'], 'integer'],
            [['last_update_time'], 'safe'],
            [['target_id'], 'string', 'max' => 100],
            [['taobao_user_id'], 'string', 'max' => 200],
            [['log_date', 'effect_type'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'target_id' => 'Target ID',
            'target_name' => 'Target Name',
            'taobao_user_id' => 'Taobao User ID',
            'cvr' => 'Cvr',
            'alipay_inshop_amt' => 'Alipay Inshop Amt',
            'alipay_in_shop_num' => 'Alipay In Shop Num',
            'gmv_inshop_amt' => 'Gmv Inshop Amt',
            'gmv_inshop_num' => 'Gmv Inshop Num',
            'cart_num' => 'Cart Num',
            'dir_shop_col_num' => 'Dir Shop Col Num',
            'inshop_item_col_num' => 'Inshop Item Col Num',
            'avg_access_page_num' => 'Avg Access Page Num',
            'avg_access_time' => 'Avg Access Time',
            'deep_inshop_uv' => 'Deep Inshop Uv',
            'uv' => 'Uv',
            'ecpm' => 'Ecpm',
            'ecpc' => 'Ecpc',
            'ctr' => 'Ctr',
            'charge' => 'Charge',
            'click' => 'Click',
            'ad_pv' => 'Ad Pv',
            'roi' => 'Roi',
            'item_cart_rate' => 'Item Cart Rate',
            'item_col_rate' => 'Item Col Rate',
            'item_cart_price' => 'Item Cart Price',
            'item_col_price' => 'Item Col Price',
            'item_cartcol_price' => 'Item Cartcol Price',
            'alipay_avg_price' => 'Alipay Avg Price',
            'alipay_avg_amt' => 'Alipay Avg Amt',
            'log_date' => 'Log Date',
            'effect' => 'Effect',
            'effect_type' => 'Effect Type',
            'last_update_time' => 'Last Update Time',
        ];
    }
}
