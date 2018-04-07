<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/7 0007
 * Time: 下午 4:01
 */

namespace backend\controllers;

use common\models\LoginForm;
use yii\web\Controller;
use Yii;

class LoginController extends Controller
{
    /**
     * 定义captcah验证码，和默认错误展示页面
     */
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'backend\controllers\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'backColor' => 0x000000,//背景颜色
                'maxLength' => 5, //最大显示个数
                'minLength' => 4,//最少显示个数
                'padding' => 3,//间距
                'height' => 50,//高度
                'width' => 90,  //宽度
                'foreColor' => 0xffffff,     //字体颜色
                'offset' => 4        //设置字符偏移量 有效果
            ],
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * 登录首页
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * 登录
     * @return string|\yii\web\Response
     */
    public function actionLoginUp()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render(
                'index',
                [
                    'model' => $model,
                ]
            );
        }
    }

    /**
     * 退出
     * @return \yii\web\Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(['login']);
    }
}