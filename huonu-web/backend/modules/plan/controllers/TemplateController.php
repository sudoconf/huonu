<?php
/**
 * Created by prtens.
 * User: hx
 * Date: 2018/5/8 14:05
 */

namespace backend\modules\plan\controllers;

use backend\controllers\BaseController;
use backend\modules\plan\services\TemplateService;
use Yii;
use yii\filters\VerbFilter;

class TemplateController extends BaseController
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
                    'ajax-create-area-template' => ['post'],
                ],
            ],
        ];
    }

    // TODO Ajax 创建地域模板
    public function actionAjaxCreateAreaTemplate()
    {
        TemplateService::service()->createAreaTemplate();
    }

    // TODO ajax 修改地域模板
    public function actionAjaxUpdateAreaTemplate()
    {
        TemplateService::service()->updateAreaTemplate();
    }

    // TODO ajax 创建时间模板
    public function actionAjaxCreateTimeTemplate()
    {
        TemplateService::service()->createTimeTemplate();
    }

    // TODO ajax 修改时间模板
    public function actionAjaxUpdateTimeTemplate()
    {
        TemplateService::service()->updateTimeTemplate();
    }
}