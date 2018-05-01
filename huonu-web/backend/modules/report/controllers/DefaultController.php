<?php

namespace backend\modules\report\controllers;

use backend\controllers\BaseController;
use backend\models\AuthorizeUser;
use backend\models\Multitray;
use backend\models\searchs\MultitraySearch;
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

        return $this->render(
            'index',
            [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]
        );
    }

    /**
     * 创建第一步 TODO
     * @return string
     */
    public function actionCreate()
    {
        $model = new Multitray();

        // print_r(Yii::$app->request->post());die;
        return $this->render(
            'create',
            [
                'model' => $model,
            ]
        );
    }

    /**
     * 第一步 ajax 获取店铺 TODO
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
     * 保存第一步骤的数据 TODO
     */
    public function actionAjaxSaveSetParameter()
    {
        $data = Yii::$app->request->post();

        // 后续在做 验证字段规则 TODO

        if (empty($data)) {
            return CtHelper::response('false', '参数错误');
        }

        if (isset($data['_csrf-backend'])) {
            unset($data['_csrf-backend']);
        }

        $setParameter = Yii::$app->session->get('setParameter');
        if ($setParameter && is_array($setParameter)) {
            Yii::$app->session->remove('setParameter');
            Yii::$app->session->set('setParameter', $data);
        }

        return CtHelper::response('true', '保存成功');
    }

    /**
     * 第二步 ajax 获取定向列表 TODO
     */
    public function actionAjaxGetTarget()
    {
        $shop = AuthorizeUser::find()->asArray()->all();
        CtHelper::response(200, 'success', $shop);
    }

    /**
     * 保存第二步骤策略组的数据 TODO
     */
    public function actionAjaxSaveStrategyGroup()
    {
        $data = Yii::$app->request->post();

        // 后续在做 验证字段规则 TODO

        if (empty($data)) {
            return CtHelper::response('false', '参数错误');
        }

        $strategyGroup = Yii::$app->session->get('strategyGroup');

        if ($strategyGroup && is_array($strategyGroup)) {
            $data = $strategyGroup + $data;
            Yii::$app->session->set('strategyGroup', $data);
        } else {
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
    public function actionGenerateStatistic()
    {

        // 生成统计数据 TODO
        ReportService::service()->create();

        // 删除 session TODO
        // 之后跳转到详情页面 TODO
    }

    /**
     * 复盘详情
     */
    public function actionShow()
    {

        // 按时日期分析
        // 按人群分析
        // 策略组按日分析
        // 定向人群按日分析

        return $this->render('show');
    }

    /**
     * 导出报表
     */
    public function actionAjaxExport()
    {

    }

}
