<?php

namespace backend\models;

use yii\base\Model;

/**
 * Signup form
 */
class Signup extends Model
{
    public $username;
    public $email;
    public $password;
    public $role;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\backend\models\Admin', 'message' => '用户名已经被占用了.'],
            ['username', 'string', 'min' => 2, 'max' => 20],

            ['email', 'trim'],
            ['email', 'required'],
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
        return [
            'username' => '管理员账号',
            'password' => '管理员密码',
            'email' => '管理员邮箱',
            'role' => '管理员角色',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new Admin();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->role = $this->role;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }
}
