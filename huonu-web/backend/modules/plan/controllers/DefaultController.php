<?php

namespace backend\modules\plan\controllers;

use yii\filters\VerbFilter;
use yii\web\Controller;

class DefaultController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
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
    public function actionIndex() {
        return $this->render('index');
    }

    // 新建计划 TODO
    public function actionCreatePlan() {
        return $this->render('create-plan');
    }

    // 改变计划状态 TODO
    public function actionAjaxChangePlanState() {
        
    }

    // 计划设置 TODO
    public function actionAjaxSetPlan() {
        
    }

    // 计划详情 TODO
    public function actionDetailPlan() {
        
    }

    // 复制计划 TODO
    public function actionAjaxCopyPlan() {
        
    }

    // 移除计划 TODO
    public function actionAjaxRemovePlan() {
        
    }

    // 置顶计划 TODO
    public function actionAjaxPlanSort() {
        
    }

    // 计划报表 TODO
    public function actionPlanReport() {
        
    }

}
