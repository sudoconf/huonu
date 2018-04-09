<?php
/**
 * Created by prtens.
 * User: hx
 * Date: 2018/4/9 12:58
 */

namespace backend\modules\system\controllers;

use backend\controllers\BaseController;
use backend\models\searchs\AdminSearch;
use Yii;

class UserController extends BaseController
{
    /**
     * 用户列表
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AdminSearch();
        // restful 获取 GET 和 POST 过来的数据（得到结果是数组）：Yii::$app->request->bodyParams[post 请求] Yii::$app->request->queryParams;[get 请求]
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}