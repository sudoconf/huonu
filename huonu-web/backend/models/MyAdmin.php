<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%my_admin}}".
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
 * @property int $created_id 创建用户
 * @property int $updated_at 修改时间
 * @property int $updated_id 修改用户
 */
class MyAdmin extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%my_admin}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password_hash'], 'required'],
            [['status', 'last_time', 'created_at', 'created_id', 'updated_at', 'updated_id'], 'integer'],
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
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'face' => 'Face',
            'role' => 'Role',
            'status' => 'Status',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'last_time' => 'Last Time',
            'last_ip' => 'Last Ip',
            'address' => 'Address',
            'created_at' => 'Created At',
            'created_id' => 'Created ID',
            'updated_at' => 'Updated At',
            'updated_id' => 'Updated ID',
        ];
    }
}
