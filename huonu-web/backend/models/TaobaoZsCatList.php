<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "taobao_zs_cat_list".
 *
 * @property string $taobao_user_id 淘宝用户id
 * @property int $cat_id 类目id
 * @property int $campaign_type 计划类型cpm:2;cpc:8
 * @property string $cat_name 类目名称
 * @property string $option_name 选项名称
 * @property string $option_value 选项值
 * @property string $last_update_time 数据最后更新时间
 */
class TaobaoZsCatList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'taobao_zs_cat_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['taobao_user_id', 'cat_id', 'campaign_type', 'option_name', 'option_value'], 'required'],
            [['cat_id', 'campaign_type'], 'integer'],
            [['last_update_time'], 'safe'],
            [['taobao_user_id'], 'string', 'max' => 100],
            [['cat_name', 'option_name', 'option_value'], 'string', 'max' => 45],
            [['taobao_user_id', 'cat_id', 'campaign_type', 'option_name', 'option_value'], 'unique', 'targetAttribute' => ['taobao_user_id', 'cat_id', 'campaign_type', 'option_name', 'option_value']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'taobao_user_id' => '淘宝用户id',
            'cat_id' => '类目id',
            'campaign_type' => '计划类型',
            'cat_name' => '类目名称',
            'option_name' => '选项名称',
            'option_value' => '选项值',
            'last_update_time' => '数据最后更新时间',
        ];
    }
}
