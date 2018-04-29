<?php

namespace backend\modules\system\controllers;

use backend\controllers\BaseController;
use backend\models\Admin;
use backend\models\SystemLog;
use common\components\CtHelper;
use Yii;
use backend\models\searchs\LogSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LogController implements the CRUD actions for Log model.
 */
class LogController extends BaseController
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
        $searchModel = new LogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * 详情
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionAjaxGetLog($id)
    {
        return CtHelper::response('200', 'success', $this->find($id));
    }

    /**
     * 查找
     * @param $id
     * @return null|static
     * @throws NotFoundHttpException
     */
    protected function find($id)
    {
        $log = SystemLog::find()->where('id=:id', [':id' => $id])->asArray()->one();
        if (!empty($log)) {
            $admin = Admin::findOne($log['created_id']);
            $log['username'] = $admin->username;
            $log['type'] = SystemLog::getTypeDescription($log['type']);
            $log['createdAt'] = date('Y-m-d H:i:s', $log['created_at']);
            return $log;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
