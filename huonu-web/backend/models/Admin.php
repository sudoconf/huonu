<?php

namespace backend\models;

use common\components\CtHelper;
use Yii;
use yii\helpers\Json;

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

    // 获取状态
    public $getStatus = [
        self::STATUS_DELETED => '删除',
        self::STATUS_ACTIVE => '活跃的',
        self::STATUS_INACTIVE => '不活跃的',
    ];

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

    /**
     * 注册
     * @return Admin|null
     * @throws \Exception
     * @throws \yii\db\Exception
     */
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

            if (!$user->validate()) {
                throw new \Exception(Json::encode($user->getErrors()));
            }

            $result = $user->save() ? $user : null;

            $currentUserName = Yii::$app->user->identity->username;

            $remarks = sprintf('%s添加了用户：%s', $currentUserName, $result->username);

            SystemLog::create(SystemLog::TYPE_CREATE, $result->getId(), $remarks, $user);

            $transaction->commit();
            return $result;
        } catch (\Exception $e) {
            $transaction->rollBack();
            exit(Json::encode(CtHelper::response(0, $e->getMessage())));
        }
    }

    /**
     * 修改状态
     * @param $id
     * @return null|static
     * @throws \yii\db\Exception
     */
    public function changeStatus($id)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {

            if ($id == Yii::$app->user->getId()) {
                CtHelper::response(200, '您不能修改自己');
            }
            $admin = self::find()->select('id')->where('id=:id', [':id' => $id])->asArray()->one();
            if (empty($admin)) {
                CtHelper::response(200, 'false');
            }

            $fields['status'] = self::STATUS_DELETED;
            Admin::updateAll($fields, ['id' => $id]);

            $transaction->commit();
            return self::findOne($id);
        } catch (\Exception $e) {
            $transaction->rollBack();
        }

    }
}
