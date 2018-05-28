<?php
/**
 * Created by prtens.
 * User: hx
 * Date: 2018/4/29 16:07
 */

namespace backend\modules\plan\controllers;

use backend\controllers\BaseController;
use backend\modules\plan\services\CreativeService;
use yii\filters\VerbFilter;

class CreativeController extends BaseController
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

    public function actionIndex()
    {
        $creative = CreativeService::service()->getCreative();
        return $this->render('index', $creative);
    }

    // TODO 创意同步
    public function actionAjaxCreativeSync()
    {

    }

    // TODO 移除创意
    public function actionAjaxRemoveCreative()
    {

    }

    // TODO 增加创意
    public function actionAddCreative()
    {

    }
}