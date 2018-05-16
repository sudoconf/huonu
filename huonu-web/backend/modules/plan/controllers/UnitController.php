<?php
/**
 * Created by prtens.
 * User: hx
 * Date: 2018/4/29 16:00
 */

namespace backend\modules\plan\controllers;

use backend\controllers\BaseController;
use backend\models\TaobaoZsAdgroupList;
use backend\modules\plan\services\UnitService;
use yii\data\Pagination;
use yii\filters\VerbFilter;

class UnitController extends BaseController
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
        $query = TaobaoZsAdgroupList::find();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy(['adgroup_id' => SORT_DESC])
            ->all();
        return $this->render('index', [
            'models' => $models,
            'pagination' => $pages,
        ]);
    }

    // TODO ajax 保存单元设置
    public function actionAjaxSaveSetUnit()
    {
    }

    // TODO 改变单元状态
    public function actionAjaxChangeUnitState()
    {
        UnitService::service()->changeUnitState();
    }

    // TODO 移除单元
    public function actionAjaxRemoveUnit()
    {
        UnitService::service()->removeUnit();
    }

    // TODO 单元同步
    public function actionAjaxUnitSync()
    {
        UnitService::service()->unitSync();
    }

    // TODO 新建单元
    public function actionAjaxCreateUnit()
    {
    }
}