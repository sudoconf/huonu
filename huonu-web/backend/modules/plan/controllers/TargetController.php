<?php
/**
 * Created by prtens.
 * User: hx
 * Date: 2018/4/29 16:05
 */


namespace backend\modules\plan\controllers;

use backend\controllers\BaseController;
use yii\filters\VerbFilter;

class TargetController extends BaseController
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

    // TODO 定向同步
    public function actionAjaxTargetSync()
    {

    }

    // TODO 移除定向
    public function actionAjaxRemoveTarget()
    {

    }

    // TODO 增加定向
    public function actionAddTarget()
    {

    }

}