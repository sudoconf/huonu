<?php

namespace backend\models;

use common\components\CtHelper;
use Yii;
use yii\db\Expression;
use yii\helpers\Json;

/**
 * This is the model class for table "{{%log}}".
 *
 * @property int $id 日志ID
 * @property int $type 日志类型
 * @property string $module 模块
 * @property string $controller 控制器
 * @property string $action 方法
 * @property string $url 请求地址
 * @property string $params 请求参数
 * @property string $ip 操作用户IP
 * @property int $agent 操作用户浏览器代理商
 * @property int $created_at 创建时间
 * @property int $created_id 创建用户
 */
class Log extends \yii\db\ActiveRecord
{
    const TYPE_CREATE = 1; // 创建
    const TYPE_UPDATE = 2; // 修改
    const TYPE_DELETE = 3; // 删除
    const TYPE_OTHER = 4;  // 其他
    const TYPE_UPLOAD = 5;  // 上传

    public $username;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['module', 'controller', 'action', 'url', 'params', 'agent', 'ip'], 'required'],
            [['params'], 'string'],
            [['created_at', 'created_id', 'type'], 'integer'],
            [['module', 'controller', 'action'], 'string', 'max' => 64],
            [['url'], 'string', 'max' => 100],
            [['agent'], 'string', 'max' => 255],
            [['ip'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '日志ID',
            'type' => '日志类型',
            'module' => '模块',
            'controller' => '控制器',
            'action' => '方法',
            'url' => '请求地址',
            'params' => '请求参数',
            'ip' => '操作用户IP',
            'agent' => '操作用户浏览器代理商',
            'created_at' => '创建时间',
            'created_id' => '创建用户',
            'username' => '操作人',
        ];
    }

    /**
     * 获取类型说明
     * @param null $type
     * @return array|mixed|null
     */
    public static function getTypeDescription($type = null)
    {
        $mixReturn = [
            self::TYPE_CREATE => '创建',
            self::TYPE_UPDATE => '修改',
            self::TYPE_DELETE => '删除',
            self::TYPE_OTHER => '其他',
            self::TYPE_UPLOAD => '上传',
        ];

        if ($type !== null) {
            $mixReturn = isset($mixReturn[$type]) ? $mixReturn[$type] : null;
        }

        return $mixReturn;
    }

    /**
     * 创建日志
     * @param $type
     * @param array $params
     * @return string
     * @throws \yii\db\Exception
     */
    public static function create($type, $params = [])
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {

            $log = new self();
            $log->type = $type;
            $log->params = Json::encode($params);
            $log->module = Yii::$app->controller->module->id;
            $log->controller = Yii::$app->controller->id;
            $log->action = Yii::$app->controller->action->id;
            $log->url = Yii::$app->request->url;
            $log->ip = CtHelper::getIpAddress();
            $log->created_id = Yii::$app->user->id;
            $log->created_at = time();
            $headers = Yii::$app->request->headers;
            if ($headers->has('User-Agent')) {
                $log->agent = $headers->get('User-Agent');
            }

            if (!$log->validate()) {
                throw new \Exception(Json::encode($log->getErrors()));
            }

            $log->save();
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            return Json::encode($e->getMessage());
        }
    }
}
