<?php
/**
 * Created by prtens.
 * User: hx
 * Date: 2018/4/29 16:07
 */

namespace backend\modules\plan\controllers;

use backend\controllers\BaseController;
use yii\filters\VerbFilter;

class ResourceController extends BaseController
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

    // TODO 资源位同步
    public function actionAjaxResourceSync()
    {

    }

    // TODO 移除资源位
    public function actionAjaxRemoveResource()
    {

    }

    // TODO 增加资源位
    public function actionAddResource()
    {

    }
}