<?php
/**
 * Created by prtens.
 * User: hx
 * Date: 2018/5/4 14:51
 */

namespace backend\modules\report\services;

use common\components\CtHelper;
use common\services\BaseService;
use Yii;

class StrategyGroupService extends BaseService
{

    /**
     * 保存策略组
     */
    public function saveStrategyGroup()
    {
        $data = Yii::$app->request->post();

        if (empty($data)) {
            return CtHelper::response('false', '参数错误');
        }

        // TODO 校验提交的字段
        $this->check();

        $strategyGroup = Yii::$app->session->get('strategyGroup');

        if (!$strategyGroup && !is_array($strategyGroup)) {
            Yii::$app->session->set('strategyGroup', $data);
        } else {
            $data = $strategyGroup + $data;
            Yii::$app->session->remove('strategyGroup');
            Yii::$app->session->set('strategyGroup', $data);
        }
        return CtHelper::response('true', '保存成功');
    }

    /**
     * 删除策略组
     */
    public function delStrategyGroup()
    {
        $strategyGroup = Yii::$app->session->get('strategyGroup');

        $targetName = Yii::$app->request->post('targetName');
        if (!$targetName && array_key_exists($targetName, $strategyGroup)) {
            return CtHelper::response('false', '参数错误');
        }

        unset($strategyGroup[$targetName]);

        Yii::$app->session->set('strategyGroup', $strategyGroup);

        return CtHelper::response('true', '删除成功');
    }

    /**
     * 编辑策略组
     */
    public function editStrategyGroup(){}

    // 检测参数
    private function check()
    {
    }

}