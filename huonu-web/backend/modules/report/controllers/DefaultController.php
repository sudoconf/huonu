<?php

namespace backend\modules\report\controllers;

use backend\controllers\BaseController;
use backend\models\AuthorizeUser;
use backend\models\MultitrayStatistics;
use backend\models\searchs\MultitraySearch;
use backend\models\TaobaoZsAdvertiserTargetDaySumList;
use backend\models\TaobaoZsTargetList;
use backend\modules\report\services\ReportService;
use backend\modules\report\services\SetUpParameterService;
use backend\modules\report\services\StrategyGroupService;
use common\components\CtHelper;
use yii\filters\VerbFilter;
use Yii;

/**
 * Default controller for the `report` module
 */
class DefaultController extends BaseController
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * 列表
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MultitraySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]
        );
    }

    /**
     * 删除复盘
     */
    public function actionAjaxDelete()
    {
        ReportService::service()->deleteOperation();
    }

    /**
     * 创建第一步
     * @return string
     */
    public function actionCreate()
    {
        $result = ReportService::service()->create();
        return $this->render('create', $result);
    }

    /**
     * 第一步 ajax 获取店铺
     */
    public function actionAjaxGetShop()
    {
        $inputStr = Yii::$app->request->get('inputStr');
        $shop = AuthorizeUser::find()
            ->where(['like', 'taobao_user_nick', $inputStr])
            ->asArray()->all();
        CtHelper::response(200, 'success', $shop);
    }

    /**
     * TODO 保存第一步骤的数据
     */
    public function actionAjaxSaveSetParameter()
    {
        SetUpParameterService::service()->saveParameter();
    }

    /**
     * TODO 第二步 ajax 获取定向列表
     */
    public function actionAjaxGetTarget()
    {
        $taobaoId = Yii::$app->request->get('taobao_id');
        $shop = TaobaoZsTargetList::find()->select('id as target_id,crowd_name as target_name')->where(['taobao_user_id' => $taobaoId])->limit(50)->asArray()->all();
        CtHelper::response(200, 'success', $shop);
    }

    /**
     * 保存第二步骤策略组的数据
     */
    public function actionAjaxSaveStrategyGroup()
    {
        StrategyGroupService::service()->saveStrategyGroup();
    }

    // TODO 修改策略组数据
    public function actionAjaxEditStrategyGroup()
    {
        StrategyGroupService::service()->editStrategyGroup();
    }

    /**
     * 删除策略组数据
     */
    public function actionAjaxDelStrategyGroup()
    {
        StrategyGroupService::service()->delStrategyGroup();
    }

    /**
     * 第三步 生成统计数据
     */
    public function actionAjaxGenerateStatistic()
    {
        ReportService::service()->createOperation();
    }

    /**
     * TODO Ajax 导出报表
     */
    public function actionAjaxExport()
    {
        ReportService::service()->exportOperation();
    }

    /**
     * 复盘详情
     */
    public function actionShow()
    {
        $reportData = ReportService::service()->getShowOperation();
        return $this->render('show', [
            'reportData' => $reportData
        ]);
    }

    /**
     * Ajax 获取复盘统计数据
     */
    public function actionAjaxGetStatisticData()
    {
        $multitrayId = Yii::$app->request->get('multitrayId');
        $multitrayStatistics = MultitrayStatistics::find()->where(['multitray_id' => $multitrayId])->asArray()->one();

        return CtHelper::response('true', 'ok', $multitrayStatistics);
    }

}
