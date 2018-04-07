<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/7 0007
 * Time: 下午 7:43
 */

namespace backend\controllers;

use yii\web\Response;
use Yii;

class CaptchaAction extends \yii\captcha\CaptchaAction
{
    /**
     * 默认验证码刷新页面不会自动刷新
     */
    public function run()
    {
        $this->setHttpHeaders();
        Yii::$app->response->format = Response::FORMAT_RAW;

        return $this->renderImage($this->getVerifyCode(true));
    }
}