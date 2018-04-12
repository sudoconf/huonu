<?php
/**
 * Created by prtens.
 * User: hx
 * Date: 2018/4/9 12:58
 */

namespace backend\modules\system\controllers;

use backend\controllers\BaseController;
use backend\models\AuthItem;
use backend\models\searchs\AdminSearch;
use backend\models\Signup;
use Yii;
use yii\bootstrap\ActiveForm;
use yii\db\Query;
use yii\filters\VerbFilter;
use yii\web\Response;

class UserController extends BaseController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'signup' => ['post'],
                ],
            ],
        ];
    }

    /**
     * 用户列表
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AdminSearch();
        // restful 获取 GET 和 POST 过来的数据（得到结果是数组）：Yii::$app->request->bodyParams[post 请求] Yii::$app->request->queryParams;[get 请求]
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // 获取角色
        $authItem = (new Query())
            ->select('name')
            ->from(AuthItem::tableName())
            ->where('type=:type', [':type' => 1])
            ->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'authItem' => array_column($authItem, 'name'),
            'adminModel' => new Signup()
        ]);
    }

    public function actionSignup()
    {
        $model = new Signup();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['status' => $model->signup()];
        }
    }
}