<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/27 0027
 * Time: 下午 10:36
 */

namespace backend\modules\plan\services;

use common\components\CtHelper;
use common\components\Toolkit\ArrayToolkit;
use common\services\BaseService;
use Yii;
use yii\base\InvalidArgumentException;

// 计划 service TODO
class PlanService extends BaseService
{
    // 新建计划
    public function createPlan()
    {
        $whetherOrNotCompletePlan = Yii::$app->session->get('whetherOrNotCompletePlan');
        if ($whetherOrNotCompletePlan) {
            Yii::$app->session->remove('setPlan');
            Yii::$app->session->remove('whetherOrNotCompletePlan');
        }

        $setPlan = Yii::$app->session->get('setPlan');
        if (empty($setPlan) && !isset($setPlan['taobao_shop_name'])) {
            $setPlan['taobao_user_id'] = '';
            $setPlan['taobao_shop_name'] = '';
            $setPlan['marketingAim'] = '';
            $setPlan['campaign_name'] = sprintf('智行慧投_自定义计划_%s', date('Ymd_His'));
            $setPlan['campaign_type'] = '';
            $setPlan['region'] = '';
            $setPlan['area_template_id'] = '';
            $setPlan['period_type'] = '';
            $setPlan['time_template_id'] = '';
            $setPlan['campaign_start_time'] = '';
            $setPlan['campaign_end_time'] = '';
            $setPlan['campaign_speed_type'] = '';
            $setPlan['campaign_day_budget'] = '';
        }

        $result = [
            'setPlan' => $setPlan
        ];

        return $result;
    }

    // TODO 保存计划设置到session
    public function savePlan()
    {
        $data = Yii::$app->request->post();

        if (empty($data)) {
            return CtHelper::response(false, '参数错误');
        }

        // 校验提交的字段
        $this->filterCreatePlanFields($data);

        $setPlan = Yii::$app->session->get('setPlan');
        if ($setPlan && is_array($setPlan)) {
            Yii::$app->session->remove('setPlan');
        }
        Yii::$app->session->set('setPlan', $data);

        return CtHelper::response('true', '保存成功');
    }

    // TODO 修改计划状态
    public function changePlanState()
    {
    }

    // TODO 计划设置
    public function setPlan()
    {
    }

    // TODO 复制计划
    public function copyPlan()
    {
    }

    // TODO 移除计划
    public function removePlan()
    {
    }

    // TODO 计划置顶
    public function planSort()
    {
    }

    /**
     * 检测参数
     * @param $fields
     * @return mixed
     */
    protected function filterCreatePlanFields($fields)
    {
        $requiredFields = array(
            'taobao_user_id',
            'taobao_shop_name',
            'campaign_name',
            'campaign_type',
            'area_template_id',
            'time_template_id',
            'campaign_start_time',
            'campaign_end_time',
            'campaign_speed_type',
            'campaign_day_budget',
        );

        if (!ArrayToolkit::requires($fields, $requiredFields)) {
            throw new InvalidArgumentException('Missing required fields when creating course');
        }

        return $fields;
    }
}