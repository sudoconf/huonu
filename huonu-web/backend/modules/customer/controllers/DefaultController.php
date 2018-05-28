<?php

namespace backend\modules\customer\controllers;

use backend\controllers\BaseController;
use backend\modules\customer\services\CustomerService;
use Yii;
use backend\models\TaobaoAuthorizeUser;
use backend\models\searchs\TaobaoAuthorizeUserSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class DefaultController extends BaseController
{
    /**
     * {@inheritdoc}
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
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TaobaoAuthorizeUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return null|static
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = TaobaoAuthorizeUser::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * 数据同步
     */
    public function actionAjaxSync()
    {
        CustomerService::service()->SyncOperation();
    }

    /**
     * 禁用
     */
    public function actionAjaxForbid()
    {
        CustomerService::service()->forbid();
    }
}