<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%user_area_template}}".
 *
 * @property string $area_template_id
 * @property int $taobao_user_id 淘宝用户id
 * @property string $area_template_name 地域模板名称
 * @property string $area_id_list 地域id列表 
 */
class UserAreaTemplate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_area_template}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['taobao_user_id', 'area_template_name', 'area_id_list'], 'required'],
            [['taobao_user_id'], 'integer'],
            [['area_id_list'], 'string', 'max' => 255],

            ['area_template_name', 'trim'],
            [['area_template_name'], 'unique', 'targetClass' => '\backend\models\UserAreaTemplate', 'message' => '已存在同名模板.'],
            ['area_template_name', 'string', 'min' => 2, 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'area_template_id' => 'Area Template ID',
            'taobao_user_id' => '淘宝用户id',
            'area_template_name' => '地域模板名称',
            'area_id_list' => '地域id列表',
        ];
    }
}
