<?php
/**
 * Created by prtens.
 * User: hx
 * Date: 2018/4/9 16:23
 */

namespace backend\modules\system\controllers;

use backend\controllers\BaseController;
use backend\models\AuthItem;
use backend\models\searchs\AuthItemSearch;
use yii\filters\VerbFilter;
use Yii;
use yii\rbac\Item;
use yii\web\NotFoundHttpException;

/**
 * @property integer $type
 * Class ItemController
 * @package backend\modules\system\controllers
 */
class RoleController extends BaseController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'assign' => ['post'],
                    'remove' => ['post'],
                ],
            ],
        ];
    }

    public function getType()
    {
        return Item::TYPE_ROLE;
    }

    /**
     * 首页
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AuthItemSearch(['type' => $this->type]);
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'authItem' => new AuthItem()
        ]);
    }

    /**
     * 添加
     * @return string|\yii\web\Response
     */
    public function actionAjaxCreate()
    {
        $model = new AuthItem(null);
        $model->type = $this->type;
        if ($model->load(Yii::$app->getRequest()->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->name]);
        } else {
            return $this->render('create', ['model' => $model]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->getRequest()->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->name]);
        }

        return $this->render('update', ['model' => $model]);
    }

    /**
     * 根据其主键值找到AuthItem模型。
     * 如果没有找到模型，就会抛出404个HTTP异常
     * @param $id
     * @return AuthItem
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        $auth = Yii::$app->authManager;
        $item = $this->type === Item::TYPE_ROLE ? $auth->getRole($id) : $auth->getPermission($id);
        if ($item) {
            return new AuthItem($item);
        } else {
            throw new NotFoundHttpException('所请求的页面不存在.');
        }
    }
}