<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "taobao_zs_target_list".
 *
 * @property int $id 定向人群id
 * @property string $taobao_user_id 淘宝卖家id
 * @property int $adgroup_id 单元id
 * @property int $campaign_id 计划id
 * @property string $crowd_name 定向人群名称
 * @property int $crowd_type 定向人群类型
 * @property string $crowd_value 定向人群取值，根据不同定向类型表示不同含义
 * @property string $gmt_create 创建时间
 * @property string $gmt_modified 修改时间
 * @property string $matrix_price_d_t_o 交叉出价对象
 * @property string $sub_crowd_d_t_o 定向子人群
 * @property string $last_update_time
 */
class TaobaoZsTargetList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'taobao_zs_target_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'taobao_user_id', 'adgroup_id', 'campaign_id'], 'required'],
            [['id', 'adgroup_id', 'campaign_id', 'crowd_type'], 'integer'],
            [['sub_crowd_d_t_o'], 'string'],
            [['last_update_time'], 'safe'],
            [['taobao_user_id', 'matrix_price_d_t_o'], 'string', 'max' => 255],
            [['crowd_name', 'gmt_create', 'gmt_modified'], 'string', 'max' => 100],
            [['crowd_value'], 'string', 'max' => 45],
            [['id', 'taobao_user_id', 'adgroup_id', 'campaign_id'], 'unique', 'targetAttribute' => ['id', 'taobao_user_id', 'adgroup_id', 'campaign_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'taobao_user_id' => 'Taobao User ID',
            'adgroup_id' => 'Adgroup ID',
            'campaign_id' => 'Campaign ID',
            'crowd_name' => 'Crowd Name',
            'crowd_type' => 'Crowd Type',
            'crowd_value' => 'Crowd Value',
            'gmt_create' => 'Gmt Create',
            'gmt_modified' => 'Gmt Modified',
            'matrix_price_d_t_o' => 'Matrix Price D T O',
            'sub_crowd_d_t_o' => 'Sub Crowd D T O',
            'last_update_time' => 'Last Update Time',
        ];
    }
}
