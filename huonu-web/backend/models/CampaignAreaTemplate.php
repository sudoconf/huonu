<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%campaign_area_template}}".
 *
 * @property string $area_template_id
 * @property int $campaign_id 计划id
 * @property int $taobao_user_id 淘宝用户id
 * @property string $area_template_name 地域模板名称
 * @property string $area_id_list 地域id列表
 */
class CampaignAreaTemplate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%campaign_area_template}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['campaign_id', 'taobao_user_id', 'area_template_name', 'area_id_list'], 'required'],
            [['campaign_id', 'taobao_user_id'], 'integer'],
            [['area_template_name'], 'string', 'max' => 30],
            [['area_id_list'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'area_template_id' => 'Area Template ID',
            'campaign_id' => 'Campaign ID',
            'taobao_user_id' => 'Taobao User ID',
            'area_template_name' => 'Area Template Name',
            'area_id_list' => 'Area Id List',
        ];
    }
}
