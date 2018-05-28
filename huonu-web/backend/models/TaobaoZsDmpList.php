<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "taobao_zs_dmp_list".
 *
 * @property string $taobao_user_id
 * @property int $coverage 覆盖人数
 * @property string $enable_time 人群生效时间
 * @property string $dmp_crowd_name DMP人群名称
 * @property int $dmp_crowd_id DMP人群ID
 * @property string $update_time 人群修改时间
 * @property string $last_update_time
 */
class TaobaoZsDmpList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'taobao_zs_dmp_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['taobao_user_id', 'dmp_crowd_id'], 'required'],
            [['coverage', 'dmp_crowd_id'], 'integer'],
            [['last_update_time'], 'safe'],
            [['taobao_user_id', 'enable_time', 'dmp_crowd_name', 'update_time'], 'string', 'max' => 100],
            [['taobao_user_id', 'dmp_crowd_id'], 'unique', 'targetAttribute' => ['taobao_user_id', 'dmp_crowd_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'taobao_user_id' => '淘宝用户ID',
            'coverage' => '覆盖人数',
            'enable_time' => '人群生效时间',
            'dmp_crowd_name' => 'DMP人群名称',
            'dmp_crowd_id' => 'DMP人群ID',
            'update_time' => '人群修改时间',
            'last_update_time' => 'Last Update Time',
        ];
    }
}
