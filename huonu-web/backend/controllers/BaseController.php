<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/7 0007
 * Time: 下午 3:02
 */

namespace backend\controllers;

use common\components\CtHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UnauthorizedHttpException;
use Yii;

class BaseController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * 请求之前的数据验证
     * @param $action
     * @return bool
     * @throws UnauthorizedHttpException
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        // 主控制器验证
        if (parent::beforeAction($action)) {
            // 验证权限
            if (!Yii::$app->user->can($action->controller->id . '/' . $action->id) && Yii::$app->getErrorHandler()->exception === null) {
                // 没有权限AJAX返回
                if (Yii::$app->request->isAjax) {
                    // CtHelper::response(false, '对不起，您现在还没获得该操作的权限!');
                }

                // throw new UnauthorizedHttpException('对不起，您现在还没获得该操作的权限!');
            }

            return true;
        }

        return false;
    }
}