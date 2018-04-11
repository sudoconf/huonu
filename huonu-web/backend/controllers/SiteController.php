<?php
/**
 * Created by prtens.
 * User: hx
 * Date: 2018/4/8 14:32
 */

namespace backend\controllers;

use backend\models\Admin;
use backend\models\AdminLoginForm;
use common\components\CtHelper;
use Yii;

class SiteController extends BaseController
{
    public function actions()
    {
        // return [
        //     'captcha' => [
        //         'class' => 'backend\controllers\CaptchaAction',
        //         'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
        //         'backColor' => 0x000000,//背景颜色
        //         'maxLength' => 5, //最大显示个数
        //         'minLength' => 4,//最少显示个数
        //         'padding' => 3,//间距
        //         'height' => 50,//高度
        //         'width' => 90,  //宽度
        //         'foreColor' => 0xffffff,     //字体颜色
        //         'offset' => 4        //设置字符偏移量 有效果
        //     ],
        //     'error' => [
        //         'class' => 'yii\web\ErrorAction',
        //     ],
        // ];
    }

    /**
     * 显示首页系统信息
     * @return string
     */
    public function actionIndex()
    {
        // 用户信息
        Yii::$app->view->params['admin'] = Yii::$app->getUser()->identity;

        return $this->render('system', [
            'yii' => 'Yii ' . Yii::getVersion(), // Yii 版本
            'upload' => ini_get('upload_max_filesize'), // 上传文件大小
        ]);
    }

    /**
     * 后台登录
     * @return string|\yii\web\Response
     */
    public function actionLogin()
    {
        $this->layout = 'login.php';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new AdminLoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack(); // 到首页去
        } else {
            $model->password = '';
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * 后台管理员退出
     * @return \yii\web\Response
     */
    public function actionLogout()
    {
        // 用户退出修改登录时间
        $admin = Admin::findOne(Yii::$app->user->id);
        if ($admin) {
            $admin->last_time = time();
            $admin->last_ip = CtHelper::getIpAddress();
            $admin->save();
        }

        Yii::$app->user->logout();
        return $this->goHome();
    }
}