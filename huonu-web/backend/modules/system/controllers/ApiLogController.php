<?php

namespace backend\modules\system\controllers;

use common\components\CtHelper;
use Yii;
use backend\models\ApiLogs;
use backend\models\searchs\ApiLogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ApiLogController implements the CRUD actions for ApiLogs model.
 */
class ApiLogController extends Controller
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
     * Lists all ApiLogs models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ApiLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @throws NotFoundHttpException
     */
    public function actionAjaxGetLog($id)
    {
        $apiLog = $this->findModel($id);
        CtHelper::response(true, '', $apiLog);
    }

    /**
     * @param $id
     * @return null|static
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = ApiLogs::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('所请求的页面不存在.');
    }
}
