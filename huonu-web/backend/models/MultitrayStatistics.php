<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%multitray_statistics}}".
 *
 * @property string $id
 * @property int $multitray_id 复盘id
 * @property string $multitray_statistics_content_json 统计数据(以 json 格式存储)
 * @property string $charge 总花费
 * @property string $alipay_inshop_amt 总成交额
 * @property string $roi 总消耗产出比
 * @property string $commodity_collection_rate 总商品收藏率
 * @property string $purchase_rate 总商品加购率
 * @property string $purchase_cost_of_goods_collection 总商品收藏加购成本
 */
class MultitrayStatistics extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%multitray_statistics}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['multitray_id', 'multitray_statistics_content_json'], 'required'],
            [['multitray_id'], 'integer'],
            [['multitray_statistics_content_json'], 'string'],
            [['charge', 'alipay_inshop_amt', 'roi', 'commodity_collection_rate', 'purchase_rate', 'purchase_cost_of_goods_collection'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'multitray_id' => '复盘id',
            'multitray_statistics_content_json' => '统计数据',
            'charge' => '总花费',
            'alipay_inshop_amt' => '总成交额',
            'roi' => '总消耗产出比',
            'commodity_collection_rate' => '总商品收藏率',
            'purchase_rate' => '总商品加购率',
            'purchase_cost_of_goods_collection' => '总商品收藏加购成本',
        ];
    }
}
