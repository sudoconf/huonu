<?php
/**
 * Created by prtens.
 * User: hx
 * Date: 2018/4/25 13:46
 */

namespace backend\modules\report\controllers;

use backend\controllers\BaseController;
use Yii;
use backend\models\TaobaoAuthorizeUser;
use backend\models\searchs\TaobaoAuthorizeUserSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class DataSyncController extends BaseController
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
     * @return mixed
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

        throw new NotFoundHttpException('所请求的页面不存在.');
    }

    // TODO ajax 数据同步
    public function actionAjaxDataSync()
    {
    }

}