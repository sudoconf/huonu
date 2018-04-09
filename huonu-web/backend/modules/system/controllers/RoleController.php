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
}