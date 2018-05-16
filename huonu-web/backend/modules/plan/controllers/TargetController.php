<?php
/**
 * Created by prtens.
 * User: hx
 * Date: 2018/4/29 16:05
 */


namespace backend\modules\plan\controllers;

use backend\controllers\BaseController;
use backend\models\TaobaoZsTargetList;
use backend\modules\plan\services\TargetService;
use yii\data\Pagination;
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

    public function actionIndex()
    {
        $query = TaobaoZsTargetList::find();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy(['id' => SORT_DESC])
            ->all();
        return $this->render('index', [
            'models' => $models,
            'pagination' => $pages,
        ]);
    }

    // TODO 移除定向
    public function actionAjaxRemoveTarget()
    {
        TargetService::service()->removeTarget();
    }

    // TODO 定向同步
    public function actionAjaxTargetSync()
    {
        TargetService::service()->targetSync();
    }

    // TODO 增加定向
    public function actionAddTarget()
    {

    }

}