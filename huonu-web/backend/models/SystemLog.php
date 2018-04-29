<?php

namespace backend\models;

use common\components\CtHelper;
use Yii;
use yii\helpers\Json;

/**
 * This is the model class for table "{{%system_log}}".
 *
 * @property int $id 日志ID
 * @property int $operation_id 操作的id
 * @property int $type 日志类型(1 新增 2 修改 3删除)
 * @property string $module 模块
 * @property string $controller 控制器
 * @property string $action 方法
 * @property string $url 请求地址
 * @property string $params 请求参数
 * @property string $agent 操作用户浏览器代理商
 * @property string $ip 操作用户IP
 * @property int $created_at 创建时间
 * @property int $created_id 创建用户
 * @property string $remarks 备注
 */
class SystemLog extends \yii\db\ActiveRecord
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
        return '{{%system_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['operation_id', 'created_at', 'created_id'], 'integer'],
            [['module', 'controller', 'action', 'url', 'params', 'agent', 'ip', 'remarks'], 'required'],
            [['params'], 'string'],
            [['type'], 'string', 'max' => 1],
            [['module', 'controller', 'action'], 'string', 'max' => 64],
            [['url'], 'string', 'max' => 100],
            [['agent'], 'string', 'max' => 255],
            [['ip'], 'string', 'max' => 15],
            [['remarks'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '日志ID',
            'operation_id' => '操作ID',
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
            'remarks' => '备注',
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
     * @param int $operationId
     * @param $remarks
     * @param array $params
     * @return string
     * @throws \yii\db\Exception
     */
    public static function create($type, $operationId = 0, $remarks, $params = [])
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {

            $logData['operation_id'] = $operationId;
            $logData['type'] = $type;
            $logData['params'] = Json::encode($params);
            $logData['module'] = Yii::$app->controller->module->id;
            $logData['controller'] = Yii::$app->controller->id;
            $logData['action'] = Yii::$app->controller->action->id;
            $logData['url'] = Yii::$app->request->url;
            $logData['ip'] = CtHelper::getIpAddress();
            $logData['created_id'] = Yii::$app->user->id;
            $logData['created_at'] = time();
            $logData['remarks'] = $remarks;

            $headers = Yii::$app->request->headers;
            if ($headers->has('User-Agent')) {
                $logData['agent'] = $headers->get('User-Agent');
            }

            $log = new self();
            $log->setAttributes($logData);
            print_r($log->save());die;
            if (!$log->save()) {
                throw new \Exception(Json::encode($log->getErrors()));
            }
            die;
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            return Json::encode($e->getMessage());
        }
    }
}
