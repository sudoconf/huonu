<?php
/**
 * Created by prtens.
 * User: hx
 * Date: 2018/4/29 16:00
 */

namespace backend\modules\plan\controllers;

use backend\controllers\BaseController;
use yii\filters\VerbFilter;

class UnitController extends BaseController
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

    // TODO 改变单元状态
    public function actionAjaxChangeUnitState()
    {
    }

    // TODO 单元同步
    public function actionAjaxUnitSync()
    {
    }

    // TODO 移除单元
    public function actionAjaxRemoveUnit()
    {
    }

    // TODO 新建单元
    public function actionAjaxCreateUnit()
    {
    }
}