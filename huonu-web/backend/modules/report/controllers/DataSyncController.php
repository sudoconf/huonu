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

    // 数据同步列表
    public function actionIndex()
    {
        return $this->render('index');
    }

    // ajax 数据同步 TODO
    public function actionAjaxSync()
    {
    }

}