<?php

namespace backend\modules\report\controllers;

use backend\controllers\BaseController;
use backend\models\AuthorizeUser;
use backend\models\Multitray;
use backend\models\MultitrayStatistics;
use backend\models\searchs\MultitraySearch;
use backend\models\TaobaoZsAdvertiserTargetDaySumList;
use backend\modules\report\services\ReportService;
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
     * TODO 创建第一步
     * @return string
     */
    public function actionCreate()
    {
        $model = new Multitray();

        $whetherOrNotComplete = Yii::$app->session->get('whetherOrNotComplete');
        if ($whetherOrNotComplete) {
            Yii::$app->session->remove('setParameter');
            Yii::$app->session->remove('strategyGroup');
        }

        $setParameter = Yii::$app->session->get('setParameter');
        if (empty($setParameter) && !isset($setParameter['multitray_name'])) {
            $setParameter['multitray_name'] = '';
            $setParameter['taobao_name'] = '';
            $setParameter['taobao_id'] = '';
            $setParameter['multitray_start_time'] = '';
            $setParameter['multitray_end_time'] = '';
            $setParameter['multitray_field'] = '';
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
     * TODO 第一步 ajax 获取店铺
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
        $data = Yii::$app->request->post();

        // TODO 后续在做 验证字段规则

        if (empty($data)) {
            return CtHelper::response('false', '参数错误');
        }

        if (isset($data['_csrf-backend'])) {
            unset($data['_csrf-backend']);
            unset($data['multitray_time']);
        }

        $setParameter = Yii::$app->session->get('setParameter');
        if ($setParameter && is_array($setParameter)) {
            Yii::$app->session->remove('setParameter');
            Yii::$app->session->set('setParameter', $data);
        } else {
            Yii::$app->session->set('setParameter', $data);
        }

        return CtHelper::response('true', '保存成功');
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
     * TODO 保存第二步骤策略组的数据
     */
    public function actionAjaxSaveStrategyGroup()
    {
        $data = Yii::$app->request->post();

        // TODO 后续在做 验证字段规则

        if (empty($data)) {
            return CtHelper::response('false', '参数错误');
        }

        $strategyGroup = Yii::$app->session->get('strategyGroup');

        if (!$strategyGroup && !is_array($strategyGroup)) {
            Yii::$app->session->set('strategyGroup', $data);
        } else {
            $data = $strategyGroup + $data;
            Yii::$app->session->remove('strategyGroup');
            Yii::$app->session->set('strategyGroup', $data);
        }
        return CtHelper::response('true', '保存成功');
    }

    // TODO 修改策略组数据
    public function actionAjaxEditStrategyGroup()
    {

    }

    // TODO 删除策略组数据
    public function actionAjaxDelStrategyGroup()
    {

    }

    /**
     * 第三步 生成统计数据 TODO
     */
    public function actionAjaxGenerateStatistic()
    {
        // TODO 生成统计数据
        ReportService::service()->createOperation();
    }

    /**
     * TODO 复盘详情
     */
    public function actionShow()
    {
        $reportData = ReportService::service()->getShowOperation();
        return $this->render('show', [
            'reportData' => $reportData
        ]);
    }

    // TODO Ajax 获取复盘统计数据
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
