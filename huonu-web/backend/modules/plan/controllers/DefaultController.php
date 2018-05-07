<?php

namespace backend\modules\plan\controllers;

use backend\controllers\BaseController;
use backend\modules\plan\services\PlanService;
use yii\filters\VerbFilter;

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
     * 计划列表
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
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

    }

    // TODO 置顶计划
    public function actionAjaxPlanSort()
    {

    }

    // TODO 计划报表
    public function actionPlanReport()
    {

    }

    // TODO 计划同步
    public function actionAjaxPlanSync()
    {

    }

    // TODO Ajax 创建调价模板
    public function actionAjaxCreateAdjustPriceTemplate()
    {

    }

    // TODO Ajax 创建地域模板
    public function actionAjaxCreateRegionalTemplate()
    {

    }

}
