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

    /**
     * 获取地域模板列表
     */
    public function actionAjaxGetUserAreaTemplates()
    {
        TemplateService::service()->getUserAreaTemplates();
    }

    /**
     * 创建地域模板
     */
    public function actionAjaxCreateAreaTemplate()
    {
        TemplateService::service()->createAreaTemplate();
    }

    /**
     * 修改地域模板
     */
    public function actionAjaxUpdateAreaTemplate()
    {
        TemplateService::service()->updateAreaTemplate();
    }

    /**
     * 获取地域模板列表
     */
    public function actionAjaxGetUserTimeTemplates()
    {
        TemplateService::service()->getUserTimeTemplates();
    }

    /**
     * 创建时间模板
     */
    public function actionAjaxCreateTimeTemplate()
    {
        TemplateService::service()->createTimeTemplate();
    }

    /**
     * 修改时间模板
     */
    public function actionAjaxUpdateTimeTemplate()
    {
        TemplateService::service()->updateTimeTemplate();
    }
}