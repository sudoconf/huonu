<?php
/**
 * Created by prtens.
 * User: hx
 * Date: 2018/4/25 13:46
 */

namespace backend\modules\report\controllers;

use backend\controllers\BaseController;
use yii\filters\VerbFilter;

class DataSyncController extends BaseController
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

    // TODO 数据同步列表
    public function actionIndex()
    {
        return $this->render('index');
    }

    // TODO ajax 数据同步
    public function actionAjaxDataSync()
    {
    }

}