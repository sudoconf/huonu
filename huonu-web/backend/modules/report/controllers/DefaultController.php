<?php

namespace backend\modules\report\controllers;

use backend\controllers\BaseController;
use backend\models\AuthorizeUser;
use backend\models\Multitray;
use backend\models\MultitrayStatistics;
use backend\models\searchs\MultitraySearch;
use backend\models\TaobaoZsAdvertiserTargetDaySumList;
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
        $model = new Multitray();

        $whetherOrNotComplete = Yii::$app->session->get('whetherOrNotComplete');
        if ($whetherOrNotComplete) {
            Yii::$app->session->remove('setParameter');
            Yii::$app->session->remove('strategyGroup');
            Yii::$app->session->remove('whetherOrNotComplete');
        }

        $setParameter = Yii::$app->session->get('setParameter');
        if (empty($setParameter) && !isset($setParameter['multitray_name'])) {
            $setParameter['multitray_name'] = '';
            $setParameter['taobao_name'] = '';
            $setParameter['taobao_id'] = '';
            $setParameter['multitray_start_time'] = '';
            $setParameter['multitray_end_time'] = '';
            $setParameter['multitray_effect_model'] = '';
            $setParameter['multitray_cycle'] = '';
        }
        if (!array_key_exists('multitray_field', $setParameter)) {
            $setParameter['multitray_field'] = [];
        }

        $strategyGroup = Yii::$app->session->get('strategyGroup');
        if (empty($strategyGroup)) {
            $strategyGroup = [];
        }

        return $this->render('create', [
                'model' => $model,
                'setParameter' => $setParameter,
                'strategyGroup' => $strategyGroup
            ]
        );
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
        $shop = TaobaoZsAdvertiserTargetDaySumList::find()->select('target_id,target_name')->where(['taobao_user_id' => '3015595177'])->limit(50)->asArray()->all();
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
        // 生成统计数据
        ReportService::service()->createOperation();
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

    // Ajax 获取复盘统计数据
    public function actionAjaxGetStatisticData()
    {
        $multitrayId = Yii::$app->request->get('multitrayId');
        $multitrayStatistics = MultitrayStatistics::find()->where(['multitray_id' => $multitrayId])->asArray()->one();

        return CtHelper::response('true', 'ok', $multitrayStatistics);
    }

    /**
     * TODO Ajax 导出报表
     */
    public function actionAjaxExport()
    {
        ReportService::service()->exportOperation();
    }

}
