<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/27 0027
 * Time: 下午 10:36
 */

namespace backend\modules\plan\services;

use backend\models\TaobaoAuthorizeUser;
use backend\models\TaobaoZsCampList;
use common\components\CtHelper;
use common\components\Toolkit\ArrayToolkit;
use common\components\Toolkit\CurlToolkit;
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
            $setPlan = [
                'taobao_user_id' => '',
                'taobao_shop_name' => '',
                'marketingAim' => '',
                'campaign_name' => sprintf('智行慧投_自定义计划_%s', date('Ymd_His')),
                'campaign_type' => '',
                'region' => '',
                'area_template_id' => '',
                'period_type' => '',
                'time_template_id' => '',
                'campaign_start_time' => '',
                'campaign_end_time' => '',
                'campaign_speed_type' => '',
                'campaign_day_budget' => '',
            ];
        }


        $setUnit = Yii::$app->session->get('setUnit');
        if (empty($setUnit)) {
            $setUnit = [
                'adgroup_name' => sprintf('智行慧投_自定义单元_%s', date('Ymd_His')),
            ];
        }

        $result = [
            'setPlan' => $setPlan,
            'setUnit' => $setUnit
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

    /**
     * 修改计划状态
     */
    public function changePlanState()
    {
        $get = Yii::$app->request->get();

        $taobaoZsCamp = TaobaoZsCampList::find()->where(['id' => $get['planId'], 'taobao_user_id' => $get['taobaoUserId']])->one();
        if (empty($taobaoZsCamp)) {
            CtHelper::response(false, '计划不存在');
        }

        $taobaoZsCamp->online_status = $get['onlineStatus'];

        if (!$taobaoZsCamp->save()) {
            CtHelper::response(false, $taobaoZsCamp->getErrors());
        }

        // TODO 后期同步到淘宝

        CtHelper::response(true, '状态修改成功');
    }

    // TODO 计划设置
    public function setPlan()
    {
    }

    // TODO 复制计划
    public function copyPlan()
    {
    }

    // TODO 移除计划(删除计划下面的所有东西，包括 单元、定向、资源位、创意)
    public function removePlan()
    {
        $get = Yii::$app->request->get();

        $taobaoZsCamp = TaobaoZsCampList::find()->where(['id' => $get['planId'], 'taobao_user_id' => $get['taobaoUserId']])->one();
        if (empty($taobaoZsCamp)) {
            CtHelper::response(false, '计划不存在');
        }

        // 删除单元

        // 删除定向

        // 删除资源位

        // 删除创意

        CtHelper::response(true, '删除成功');
    }

    /**
     * 计划置顶
     */
    public function planSort()
    {
        $get = Yii::$app->request->get();

        $taobaoZsCamp = TaobaoZsCampList::find()->where(['id' => $get['planId'], 'taobao_user_id' => $get['taobaoUserId']])->one();
        if (empty($taobaoZsCamp)) {
            CtHelper::response(false, '计划不存在');
        }

        if ($taobaoZsCamp->sort) {
            $taobaoZsCamp->sort = '';
        } else {
            $taobaoZsCamp->sort = 1;
        }

        if (!$taobaoZsCamp->save()) {
            CtHelper::response(false, $taobaoZsCamp->getErrors());
        }

        // TODO 后期同步到淘宝

        CtHelper::response(true, '排序成功');
    }

    // TODO 计划报表
    public function planReport()
    {

    }

    /**
     * 计划同步(包括计划下面的 单元、定向、创意、资源位)
     */
    public function ajaxPlanSync()
    {
        $request = Yii::$app->request->get();

        $taobaoZsCamp = TaobaoZsCampList::findOne($request['planId'])->toArray();
        if (empty($taobaoZsCamp)) {
            CtHelper::response(false, '计划不存在');
        }

        $userInfo = TaobaoAuthorizeUser::findOne($request['taobaoUserId'])->toArray();
        if (empty($userInfo)) {
            CtHelper::response(false, '参数错误');
        }

        $data['user_id'] = $userInfo['taobao_user_id'];
        $data['call_people'] = $userInfo['taobao_user_nick'];
        $data['campaign_id'] = $request['planId'];

        // 计划同步
        $planUrl = "http://localhost:30005/huonu/zxht/sync/camp/rtrpts";
        $planResult = CurlToolkit::request('GET', $planUrl, $data);

        // 单元同步
        $adgroupUrl = "http://localhost:30005/huonu/zxht/sync/adgroup/rtrpts";
        $adgroupResult = CurlToolkit::request('GET', $adgroupUrl, $data);

        // 定向同步
        $targetUrl = "http://localhost:30005/huonu/zxht/sync/target/rtrpts";
        $targetResult = CurlToolkit::request('GET', $targetUrl, $data);

        // 创意同步
        $creativeUrl = "http://localhost:30005/huonu/zxht/sync/creative/rtrpts";
        $creativeResult = CurlToolkit::request('GET', $creativeUrl, $data);

        // 资源位同步
        $adzoneUrl = "http://localhost:30005/huonu/zxht/sync/adzone/rtrpts";
        $adzoneResult = CurlToolkit::request('GET', $adzoneUrl, $data);

        CtHelper::response(true, '');
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