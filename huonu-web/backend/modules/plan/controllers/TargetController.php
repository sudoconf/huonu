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

    /**
     * 获取相似宝贝定向
     */
    public function actionAjaxGetSimilarBabyOrientation()
    {
        TargetService::service()->getSimilarBabyOrientation();
    }

    /**
     * 获取达摩盘定向
     */
    public function actionAjaxGetDmpOrientate()
    {
        TargetService::service()->getDmpOrientate();
    }

    // 获取访客定向
    public function actionAjaxGetVisitorsDirectional()
    {
        TargetService::service()->getVisitorsDirectional();
    }

    // 类目型定向-高级兴趣点
    public function actionAjaxGetClassOrientationAdvancedInterestPoint()
    {
        TargetService::service()->getClassOrientationAdvancedInterestPoint();
    }
}