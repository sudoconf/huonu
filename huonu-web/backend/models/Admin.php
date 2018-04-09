<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%admin}}".
 *
 * @property int $id 管理员ID
 * @property string $username 管理员账号
 * @property string $email 管理员邮箱
 * @property string $face 管理员头像
 * @property string $role 管理员角色
 * @property int $status 状态
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property int $last_time 上一次登录时间
 * @property string $last_ip 上一次登录的IP
 * @property string $address 地址信息
 * @property int $created_at 创建时间
 * @property int $updated_at 修改时间
 */
class Admin extends BaseAdmin
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password_hash'], 'required'],
            [['status', 'last_time', 'created_at', 'updated_at'], 'integer'],
            [['username', 'email', 'role'], 'string', 'max' => 64],
            [['face', 'address'], 'string', 'max' => 100],
            [['auth_key'], 'string', 'max' => 32],
            [['password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['last_ip'], 'string', 'max' => 15],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $labels = parent::attributeLabels();

        return array_merge(
            $labels,
            [
                'face' => '头像信息',
                'last_time' => '上一次登录时间',
                'last_ip' => '上一次登录的IP',
                'password' => '密码',
                're_password' => '确认密码',
            ]
        );
    }
}
