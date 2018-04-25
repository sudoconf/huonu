<?php

namespace backend\modules\report\controllers;

use backend\controllers\BaseController;
use backend\models\AuthorizeUser;
use backend\models\Multitray;
use backend\models\searchs\MultitraySearch;
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
        ]);
    }

    // 创建第一步
    public function actionCreate()
    {
        $model = new Multitray();
        // print_r(Yii::$app->request->post());die;
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    // 第一步 ajax 获取店铺
    public function actionAjaxGetShop()
    {
        $inputStr = Yii::$app->request->get('inputStr');
        $shop = AuthorizeUser::find()
            ->where(['like', 'taobao_user_nick', $inputStr])
            ->asArray()->all();
        CtHelper::response(200, 'success', $shop);
    }

    // 第二步 ajax 获取定向列表
    public function actionAjaxGetTarget()
    {
        $shop = AuthorizeUser::find()->asArray()->all();
        CtHelper::response(200, 'success', $shop);
    }

    // 第二步
    public function actionCreateTwo()
    {
    }

    // 第三步 完成，生成统计数据
    public function actionCreateThere()
    {
        // 通过策略组
    }

}
