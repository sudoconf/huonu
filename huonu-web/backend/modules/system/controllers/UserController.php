<?php
/**
 * Created by prtens.
 * User: hx
 * Date: 2018/4/9 12:58
 */

namespace backend\modules\system\controllers;

use backend\controllers\BaseController;
use backend\models\Admin;
use backend\models\AuthItem;
use backend\models\searchs\AdminSearch;
use common\components\CtHelper;
use Yii;
use yii\db\Query;
use yii\filters\VerbFilter;

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
        $authItem = array_column($authItem, 'name');
        $newAuthItem = [];
        if (!empty($authItem)) {
            foreach ($authItem as $k => $v) {
                $newAuthItem[$v] = $v;
            }
        }

        return $this->render(
            'index',
            [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'authItem' => $newAuthItem,
                'adminModel' => new Admin(),
                'status' => $searchModel->getStatus,
            ]
        );
    }

    /**
     * 添加管理员
     */
    public function actionSignup()
    {
        $model = new Admin();
        if ($model->load(Yii::$app->request->post())) {
            CtHelper::response(200, 'success', $model->signup());
        }
    }

    /**
     *
     */
    public function actionAjaxChangeStatus()
    {
        $id = Yii::$app->request->post('id');
        $model = new Admin();
        CtHelper::response(200, 'success', $model->changeStatus($id));
    }
}