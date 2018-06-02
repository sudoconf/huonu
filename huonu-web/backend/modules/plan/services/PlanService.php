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
use backend\models\UserAreaTemplate;
use backend\models\UserTimeTemplate;
use common\components\CtHelper;
use common\components\Toolkit\ArrayToolkit;
use common\components\Toolkit\CurlToolkit;
use common\services\BaseService;
use Yii;
use yii\base\InvalidArgumentException;

class PlanService extends BaseService
{
    public static $timeArr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24];

    /**
     * 新建计划
     * @return array
     */
    public function createPlan()
    {
        $whetherOrNotCompletePlan = Yii::$app->session->get('whetherOrNotCompletePlan');
        if ($whetherOrNotCompletePlan) {
            Yii::$app->session->remove('setPlan');
            Yii::$app->session->remove('whetherOrNotCompletePlan');
        }

        $setPlan = Yii::$app->session->get('setPlan');

        // 获取地域模板
        $userAreaTemplateModal = UserAreaTemplate::find()
            ->where(['taobao_user_id' => 0]);

        // 获取时间段模板
        $userTimeTemplateModal = UserTimeTemplate::find()
            ->where(['taobao_user_id' => 0]);

        if (isset($setPlan['taobao_user_id'])) {
            $userAreaTemplateModal->orWhere(['taobao_user_id' => $setPlan['taobao_user_id']]);
            $userTimeTemplateModal->orWhere(['taobao_user_id' => $setPlan['taobao_user_id']]);
        }

        if (!isset($setPlan['name'])) {

            $setPlan = [
                'taobao_user_id' => '',
                'taobao_shop_name' => '',
                'name' => sprintf('智行慧投_自定义计划_%s', date('Ymd_His')),
                'payment_type' => 2,
                'region' => '',
                'period_type' => 2,
                'start_time' => '',
                'end_time' => '',
                'speed_type' => 2,
                'day_budget' => ''
            ];
        }

        $setPlan['userAreaTemplates'] = $userAreaTemplateModal->asArray()->all();

        $setPlan['userTimeTemplates'] = $userTimeTemplateModal->asArray()->all();

        $result = [
            'setPlan' => $setPlan
        ];
        return $result;
    }

    /**
     * 保存计划设置到session
     */
    public function saveSetPlan()
    {
        $data = Yii::$app->request->post();

        if (empty($data)) {
            return CtHelper::response(false, '参数错误');
        }

        // 校验提交的字段
        $data = $this->filterCreatePlanFields($data);

        $setPlan = Yii::$app->session->get('setPlan');
        if ($setPlan && is_array($setPlan)) {
            Yii::$app->session->remove('setPlan');
        }
        Yii::$app->session->set('setPlan', $data);
        return CtHelper::response(true, '保存成功');
    }

    /**
     * 创建计划
     */
    public function savePlan()
    {
        $setPlan = Yii::$app->session->get('setPlan');
        if (empty($setPlan)) {
            CtHelper::response(false, '参数错误');
        }

        $setUnit = Yii::$app->session->get('setUnit');
        if (empty($setUnit)) {
            CtHelper::response(false, '参数错误');
        }

        $setCreative = Yii::$app->session->get('setCreative');
        if (empty($setCreative)) {
            CtHelper::response(false, '参数错误');
        }

        // 获取地域
        $userAreaTemplate = UserAreaTemplate::findOne($setPlan['area_template_id'])->toArray();
        if (empty($userAreaTemplate)) {
            CtHelper::response(false, '参数错误!');
        }

        $userTimeTemplate = UserTimeTemplate::findOne($setPlan['time_template_id'])->toArray();
        if (empty($userTimeTemplate)) {
            CtHelper::response(false, '参数错误!');
        }

        $timeTemplateWorkday = explode(',', $userTimeTemplate['time_template_workday']);
        $timeTemplateWeekend = explode(',', $userTimeTemplate['time_template_weekend']);

        $timeTemplateWorkday = implode(',', $this->timeCycle($timeTemplateWorkday));
        $timeTemplateWeekend = implode(',', $this->timeCycle($timeTemplateWeekend));

        // 计划参数
        $fields['user_id'] = $setPlan['taobao_user_id'];
        $fields['call_people'] = $setPlan['taobao_shop_name'];
        $fields['camp_workday'] = $timeTemplateWorkday;
        $fields['camp_weekend'] = $timeTemplateWeekend;
        $fields['camp_type'] = $setPlan['payment_type'];
        $fields['camp_name'] = $setPlan['name'];
        $fields['area_id_list'] = $userAreaTemplate['area_id_list'];
        $fields['speed_type'] = $setPlan['speed_type'];
        $fields['day_budget'] = $setPlan['day_budget'] * 100;
        $fields['start_time'] = $setPlan['start_time'] . ' 00:00:00';
        $fields['end_time'] = $setPlan['end_time'] . ' 00:00:00';

        // 单元参数
        $fields['intelligent_bid'] = $setUnit['intelligent_bid'];
        $fields['group_name'] = $setUnit['group_name'];

        $adzoneBidListStr = '[' . $setUnit['adzoneBidListStr'] . ']';
        $fields['adzone_bid_list'] = json_decode($adzoneBidListStr, true);

        $crowds = '[' . $setUnit['crowds'] . ']';
        $fields['crowds'] = json_decode($crowds, true);

        // 创意参数
        $fields['creativeIdList'] = $setCreative['creativeIdList'];

        $url = '192.168.8.58:8080/huonu/zxht/operate/add_all';
        $optData = 'fields=' . json_encode($fields, JSON_UNESCAPED_UNICODE);

        $result = CurlToolkit::request('POST', $url, $optData);
        CtHelper::response(true, '', $result['data']);
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
        $data['camp_id'] = $request['planId'];
        $data['call_people'] = $userInfo['taobao_user_nick'];

        // 计划同步
        // $planUrl = "http://localhost:30005/huonu/zxht/sync/camp/rtrpts";
        $planUrl = "http://192.168.8.58:8080/huonu/zxht/sync/camp/rtrpts";
        $planResult = CurlToolkit::request('GET', $planUrl, $data);

        // 单元同步
        // // $adgroupUrl = "http://localhost:30005/huonu/zxht/sync/adgroup/rtrpts";
        // $adgroupUrl = "http://192.168.8.58:8080/huonu/zxht/sync/adgroup/rtrpts";
        // $adgroupResult = CurlToolkit::request('GET', $adgroupUrl, $data);
        //
        // // 定向同步
        // // $targetUrl = "http://localhost:30005/huonu/zxht/sync/target/rtrpts";
        // $targetUrl = "http://192.168.8.58:8080/huonu/zxht/sync/target/rtrpts";
        // $targetResult = CurlToolkit::request('GET', $targetUrl, $data);
        //
        // // 创意同步
        // // $creativeUrl = "http://localhost:30005/huonu/zxht/sync/creative/rtrpts";
        // $creativeUrl = "http://192.168.8.58:8080/huonu/zxht/sync/creative/rtrpts";
        // $creativeResult = CurlToolkit::request('GET', $creativeUrl, $data);
        //
        // // 资源位同步
        // // $adzoneUrl = "http://localhost:30005/huonu/zxht/sync/adzone/rtrpts";
        // $adzoneUrl = "http://192.168.8.58:8080/huonu/zxht/sync/adzone/rtrpts";
        // $adzoneResult = CurlToolkit::request('GET', $adzoneUrl, $data);

        CtHelper::response(true, '');
    }

    /**
     * 检测参数
     * @param $fields
     * @return mixed
     */
    protected function filterCreatePlanFields($fields)
    {
        if (isset($fields['_csrf-backend'])) {
            unset($fields['_csrf-backend']);
        }

        $requiredFields = array(
            'taobao_user_id',
            'taobao_shop_name',
            'name',
            'region',
            'payment_type',
            'period_type',
            'start_time',
            'end_time',
            'speed_type',
            'day_budget',
        );

        if (!ArrayToolkit::requires($fields, $requiredFields)) {
            throw new InvalidArgumentException('Missing required fields when creating plan');
        }

        return $fields;
    }

    /**
     * 时间转换
     * @param $timeStrArr
     * @return array
     */
    public function timeCycle($timeStrArr)
    {
        $newTimeArr = [];
        foreach (self::$timeArr as $k => $v) {

            if (in_array($v, $timeStrArr)) {
                $newTimeArr[$k] = 'true';
            } else {
                $newTimeArr[$k] = 'true';
            }
        }
        return $newTimeArr;
    }
}