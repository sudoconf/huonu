<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "taobao_zs_creative_list".
 *
 * @property string $taobao_user_id
 * @property string $creative_id 创意id
 * @property string $creative_name 创意名称
 * @property int $audit_status 审核状态:-4,-1,0待审核1审核通过-2,-5,-9审核拒绝
 * @property string $audit_time 审核时间
 * @property int $cat_id 类目id
 * @property string $cat_name 类目名称
 * @property string $click_url 点击链接
 * @property string $create_time 创建时间
 * @property string $modified_time 修改时间
 * @property string $exprie_time 创意过期时间
 * @property int $creative_level 创意等级,1：一级，2：二级，3：三级，4：四级，10：十级，99：未分级
 * @property string $creative_size 创意尺寸
 * @property int $format 创意格式
 * @property string $image_path 图片地址
 * @property int $package_type 0：非标尺创意 1： 标尺创意 2：创意包
 * @property int $multi_materials 是否支持多个素材 1：支持 0：不支持
 * @property int $online_status 在线状态：1：正常，-1：回收站
 * @property string $last_update_time
 */
class TaobaoZsCreativeList extends \yii\db\ActiveRecord
{
    /**待审核
     * @var array
     */
    public static $toAudit = [-4, -1, 0];

    /**审核通过
     * @var array
     */
    public static $passAudit = [1];

    /**审核拒绝
     * @var array
     */
    public static $auditRefused = [-2, -5, -9];

    /**
     * 创意等级
     * @var array
     */
    public static $creativeLevel = [
        1 => '一级',
        2 => '二级',
        3 => '三级',
        4 => '四级',
        10 => '十级',
        99 => '未分级'
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'taobao_zs_creative_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['taobao_user_id', 'creative_id'], 'required'],
            [['audit_status', 'cat_id', 'creative_level', 'format', 'package_type', 'multi_materials', 'online_status'], 'integer'],
            [['last_update_time'], 'safe'],
            [['taobao_user_id', 'audit_time', 'create_time', 'modified_time', 'exprie_time'], 'string', 'max' => 100],
            [['creative_id', 'cat_name', 'creative_size'], 'string', 'max' => 45],
            [['creative_name', 'click_url', 'image_path'], 'string', 'max' => 255],
            [['taobao_user_id', 'creative_id'], 'unique', 'targetAttribute' => ['taobao_user_id', 'creative_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'taobao_user_id' => 'Taobao User ID',
            'creative_id' => 'Creative ID',
            'creative_name' => 'Creative Name',
            'audit_status' => 'Audit Status',
            'audit_time' => 'Audit Time',
            'cat_id' => 'Cat ID',
            'cat_name' => 'Cat Name',
            'click_url' => 'Click Url',
            'create_time' => 'Create Time',
            'modified_time' => 'Modified Time',
            'exprie_time' => 'Exprie Time',
            'creative_level' => 'Creative Level',
            'creative_size' => 'Creative Size',
            'format' => 'Format',
            'image_path' => 'Image Path',
            'package_type' => 'Package Type',
            'multi_materials' => 'Multi Materials',
            'online_status' => 'Online Status',
            'last_update_time' => 'Last Update Time',
        ];
    }
}
