<?php

namespace backend\models;

use common\components\CtHelper;
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
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password_hash'], 'required'],
            [['status', 'last_time', 'created_at', 'updated_at'], 'integer'],
            [['role'], 'string', 'max' => 64],
            [['face', 'address'], 'string', 'max' => 100],
            [['auth_key'], 'string', 'max' => 32],
            [['password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['last_ip'], 'string', 'max' => 15],
            [['password_reset_token'], 'unique'],

            ['username', 'trim'],
            [['username'], 'unique'],
            ['username', 'unique', 'targetClass' => '\backend\models\Admin', 'message' => '用户名已经被占用了.'],
            ['username', 'string', 'min' => 2, 'max' => 20],

            ['email', 'trim'],
            [['email'], 'unique'],
            ['email', 'email'],
            ['email', 'string', 'max' => 50],
            ['email', 'unique', 'targetClass' => '\backend\models\Admin', 'message' => '电子邮件地址已经被占用了.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6, 'max' => 20],

            ['role', 'required'],
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
            ]
        );
    }

    public function signup()
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $user = new self();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->role = $this->role;
            $user->password = $this->password;
            $user->setPassword($this->password);
            $user->generateAuthKey();

            $result = $user->save() ? $user : null;

            $transaction->commit();
            return $result;
        } catch (\Exception $e) {
            $transaction->rollBack();
        }
    }
}
