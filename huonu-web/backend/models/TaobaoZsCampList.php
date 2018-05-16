<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "taobao_zs_camp_list".
 *
 * @property int $id 计划ID
 * @property string $taobao_user_id
 * @property string $week_ends 投放时间:周六和周日
 * @property string $workdays 投放时间:周一到周五
 * @property int $online_status 计划状态0暂停，1投放中，9投放结束
 * @property int $speed_type 投放方式，0:尽快;1:平滑
 * @property string $start_time 开始时间
 * @property string $name 计划名称
 * @property int $type 计划类型
 * @property string $end_time 结束时间
 * @property int $day_budget 日预算（分）
 * @property int $marketingdemand 计划类型：0:未知 ，-1：自定义，1：日常托管，2：日常推荐，3：拉新托管，4：拉新推荐
 * @property string $life_cycle 草稿：1，2,完成：99
 * @property int $sort 排序
 * @property string $last_update_time
 */
class TaobaoZsCampList extends \yii\db\ActiveRecord
{
    public static $onlineStatusTitle = [
        0 => '暂停',
        1 => '投放中',
        9 => '投放结束',
    ];

    public static $onlineStatusIcon = [
        0 => 'glyphicon-pause s_fc_red',
        1 => 'glyphicon-play-circle s_fc_green',
        9 => 'glyphicon-minus-sign s_fc_9',
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'taobao_zs_camp_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'taobao_user_id'], 'required'],
            [['id', 'online_status', 'speed_type', 'type', 'day_budget', 'marketingdemand', 'sort'], 'integer'],
            [['last_update_time'], 'safe'],
            [['taobao_user_id', 'week_ends', 'workdays', 'start_time', 'name', 'end_time', 'life_cycle'], 'string', 'max' => 255],
            [['id', 'taobao_user_id'], 'unique', 'targetAttribute' => ['id', 'taobao_user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'taobao_user_id' => '淘宝用户id',
            'week_ends' => '投放时间:周六和周日',
            'workdays' => '投放时间:周一到周五',
            'online_status' => '计划状态',
            'speed_type' => '投放方式',
            'start_time' => '开始时间',
            'name' => '计划名称',
            'type' => '计划类型',
            'end_time' => '结束时间',
            'day_budget' => '日预算',
            'marketingdemand' => '计划类型',
            'life_cycle' => '草稿',
            'sort' => '拍戏',
            'last_update_time' => '最后更新时间',
        ];
    }
}
