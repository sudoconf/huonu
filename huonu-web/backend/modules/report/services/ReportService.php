<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/27 0027
 * Time: 下午 10:44
 */

namespace backend\modules\report\services;

use backend\models\Multitray;
use backend\models\MultitrayPolicyGroup;
use backend\models\SystemLog;
use common\components\CtHelper;
use common\services\BaseService;
use Yii;
use yii\db\Exception;

// 报表 service TODO
class ReportService extends BaseService {

    // 添加 复盘实际操作
    public function create() {
        $session = Yii::$app->session;

        // 第一步保存的数据
        $setParameter = Yii::$app->session->get('setParameter');

        // 第二部保存的数据
        $strategyGroup = Yii::$app->session->get('strategyGroup');

        // if (!isset($setParameter['taobao_id']) && empty($setParameter) && !isset($strategyGroup['taobao_id']) && empty($strategyGroup)) {
        //     CtHelper::response(false, '操作失败，请检查提交数据');
        // }

        $transaction = Yii::$app->db->beginTransaction();

        try {
            // 添加复盘
            $analyseArray[''] = $setParameter[''];

            $multitray = new Multitray();
            $multitray->setAttributes($analyseArray);
            if (!$multitray->save()) {
                throw new Exception('复盘添加失败' . current($multitray->getFirstErrors()));
            }
            $multitrayId = Yii::$app->db->getLastInsertID();

            // 添加复盘日志
            $analyseRemarks = sprintf('%s添加了复盘：%s', Yii::$app->user->identity->username, '');
            SystemLog::create(SystemLog::TYPE_CREATE, $multitrayId, $analyseRemarks, $setParameter['复盘名称']);


            // TODO 添加策略组 策略组最多只能有9个 所以数据库要分批存储
            $multitrayPolicyGroupArray[] = '';

            $multitrayPolicyGroup = new MultitrayPolicyGroup();
            $multitrayPolicyGroup->setAttributes($multitrayPolicyGroup);
            if (!$multitrayPolicyGroup->save()) {
                throw new Exception('策略组添加失败' . current($multitray->getFirstErrors()));
            }
            $multitrayPolicyGroupId = Yii::$app->db->getLastInsertID();

            // 添加策略组日志
            $policyGroupRemarks = sprintf('%s添加了策略组：%s', Yii::$app->user->identity->username, '');
            SystemLog::create(SystemLog::TYPE_CREATE, $multitrayPolicyGroupId, $policyGroupRemarks, $multitrayPolicyGroupArray['策略组名称']);

            // 添加完数据之后 生成统计数据 TODO


            $session->remove('setParameter');
            $session->remove('strategyGroup');

            $transaction->commit();
            CtHelper::response(true, '操作成功');
        } catch (Exception $e) {
            $transaction->rollBack();
            CtHelper::response(false, $e->getMessage());
        }
    }

}
