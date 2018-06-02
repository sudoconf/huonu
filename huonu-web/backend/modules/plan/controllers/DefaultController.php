<?php

namespace backend\modules\plan\controllers;

use backend\controllers\BaseController;
use backend\models\AuthorizeUser;
use backend\models\searchs\TaobaoZsCampListSearch;
use backend\models\TaobaoZsAdvertiserCampaignRtrptsTotalList;
use backend\models\TaobaoZsCampList;
use backend\modules\plan\services\PlanService;
use common\components\CtHelper;
use yii\data\Pagination;
use yii\filters\VerbFilter;
use Yii;

class DefaultController extends BaseController
{
    public static $get;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    '' => [''],
                ],
            ],
        ];
    }

    /**
     * 计划列表
     * @return string
     */
    public function actionIndex()
    {
        $get = Yii::$app->request->get();

        $query = TaobaoZsCampList::find();

        $query->where('0=0');

        if (isset($get['planName'])) {
            $query->andWhere(['like', 'name', $get['planName']]);
        } else {
            $get['planName'] = '';
        }

        if (isset($get['customerId']) && !empty($get['customerId'])) {
            $query->andWhere(['camp.taobao_user_id' => $get['customerId']]);
        } else {
            $get['customerId'] = '';
        }

        if (isset($get['onlineStatus']) && $get['onlineStatus'] < 99) {
            $query->andWhere(['online_status' => $get['onlineStatus']]);
        } else {
            $get['onlineStatus'] = 99;
        }

        if (isset($get['marketingdemand']) && !empty($get['marketingdemand'])) {
            $query->andWhere(['marketingdemand' => $get['marketingdemand']]);
        } else {
            $get['marketingdemand'] = '';
        }

        if (isset($get['type']) && !empty($get['type'])) {
            $query->andWhere(['type' => $get['type']]);
        } else {
            $get['type'] = '';
        }

        $query->from(TaobaoZsCampList::tableName() . ' camp')
            ->select([
                '`camp`.*',
                '`timeShare`.charge',
                '`timeShare`.ecpc',
                '`timeShare`.ad_pv',
                '`timeShare`.click',
                '`timeShare`.ecpm',
                '`timeShare`.ctr'
            ])
            ->leftJoin(TaobaoZsAdvertiserCampaignRtrptsTotalList::tableName() . ' timeShare', 'camp.id = timeShare.campaign_id');
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $camps = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy([
                'taobao_user_id' => SORT_ASC,
                'sort' => SORT_DESC,
                'id' => SORT_DESC
            ])
            ->asArray()
            ->all();

        $customers = AuthorizeUser::find()->select([
            'taobao_user_id',
            'taobao_user_nick'
        ])->asArray()->all();

        return $this->render('index', [
            'camps' => $camps,
            'pages' => $pages,
            'get' => $get,
            'customers' => $customers
        ]);
    }

    /**
     * 新建计划 页面
     * @return string
     */
    public function actionCreate()
    {
        $result = PlanService::service()->createPlan();
        return $this->render('create', $result);
    }

    /**
     * ajax 保存计划设置
     */
    public function actionAjaxSaveSetPlan()
    {
        PlanService::service()->saveSetPlan();
    }

    /**
     * 创建计划
     */
    public function actionAjaxSavePlan()
    {
        PlanService::service()->savePlan();
    }

    // TODO 改变计划状态
    public function actionAjaxChangePlanState()
    {
        PlanService::service()->changePlanState();
    }

    // TODO 计划设置
    public function actionAjaxSetPlan()
    {

    }

    // TODO 计划详情
    public function actionDetailPlan()
    {

    }

    // TODO 复制计划
    public function actionAjaxCopyPlan()
    {

    }

    // TODO 移除计划
    public function actionAjaxRemovePlan()
    {
        PlanService::service()->removePlan();
    }

    /**
     * 置顶计划
     */
    public function actionAjaxPlanSort()
    {
        PlanService::service()->planSort();
    }

    // TODO 计划报表
    public function actionPlanReport()
    {

    }

    // TODO 计划同步
    public function actionAjaxPlanSync()
    {
        PlanService::service()->ajaxPlanSync();
    }

}
