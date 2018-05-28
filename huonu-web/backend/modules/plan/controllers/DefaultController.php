<?php

namespace backend\modules\plan\controllers;

use backend\controllers\BaseController;
use backend\models\TaobaoZsCampList;
use backend\modules\plan\services\PlanService;
use yii\data\Pagination;
use yii\filters\VerbFilter;
use Yii;

class DefaultController extends BaseController
{
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
     * TODO 计划列表
     * @return string
     */
    public function actionIndex()
    {
        $query = TaobaoZsCampList::find();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy(['sort' => SORT_DESC, 'id' => SORT_DESC])
            ->all();

        return $this->render('index', [
            'models' => $models,
            'pages' => $pages,
        ]);
    }

    // TODO 新建计划 页面
    public function actionCreate()
    {
        $result = PlanService::service()->createPlan();
        return $this->render('create', $result);
    }

    // TODO ajax 保存计划设置
    public function actionAjaxSaveSetPlan()
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
