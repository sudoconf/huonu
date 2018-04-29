<?php
/**
 * Created by prtens.
 * User: hx
 * Date: 2018/4/29 16:07
 */

namespace backend\modules\plan\controllers;

use backend\controllers\BaseController;
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

    // TODO 创意同步
    public function actionAjaxCreativeSync()
    {

    }

    // TODO 移除创意
    public function actionAjaxRemoveCreative()
    {

    }
}