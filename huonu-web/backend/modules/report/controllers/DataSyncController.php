<?php
/**
 * Created by prtens.
 * User: hx
 * Date: 2018/4/25 13:46
 */

namespace backend\modules\report\controllers;

use backend\controllers\BaseController;
use backend\modules\report\services\DataSyncService;
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

    /**
     * TODO 数据同步列表
     * @return string
     */
    public function actionIndex()
    {
        $result = DataSyncService::service()->getShopNeedSync();
        return $this->render('index', $result);
    }

    // TODO ajax 数据同步
    public function actionAjaxDataSync()
    {
    }

}