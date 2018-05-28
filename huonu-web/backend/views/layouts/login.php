<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$model = new \backend\models\AdminLoginForm();
?>

<!DOCTYPE html>
<html lang="cn">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">
    <title>火奴 易通软件客户自助平台 登录</title>

    <?= Html::jsFile('@web/vendor/jquery/jquery.min.js') ?>
    <?= Html::cssFile('@web/vendor/bootstrap/css/bootstrap.min.css') ?>
    <?= Html::cssFile('@web/css/login.css') ?>
</head>

<div class="login">

    <?php $form = ActiveForm::begin(); ?>
    <center><?= Html::img('@web/images/logo.png') ?></center>

    <div class="clear"></div>

    <?= $form->field($model, 'username')->textInput(['placeholder' => $model->getAttributeLabel('username'), 'autofocus' => true])->label(false) ?>

    <?= $form->field($model, 'password')->passwordInput(['placeholder' => $model->getAttributeLabel('password')])->label(false) ?>

    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
        'name' => 'captcha-img',
        'captchaAction' => 'site/captcha',
        'imageOptions' => [
            'id' => 'captcha-img',
            'alt' => '换一个',
            'title' => '换一个',
            'style' => 'cursor:pointer;',
        ],
        'template' => '<div class="row"><div class="col-lg-4">{image}</div><div class="col-lg-8">{input}</div></div>',
    ]) ?>
    <input id="admin-url" type="hidden" value="<?= \yii\helpers\Url::toRoute('/site/captcha') ?>">

    <?= $form->field($model, 'rememberMe')->checkbox() ?>

    <p>其他方式登录：<a href="<?=\yii\helpers\Url::toRoute('oauth/get-code')?>">淘宝登录</a></p>

    <button type="submit" class="btn btn-primary" name="login-button">登录</button>
    <?php ActiveForm::end(); ?>

    <div class="clear"></div>

    <div class="copyright">© 火奴软件 2012-2018</div>

</div>

<script>
    $(function () {
        //解决验证码不刷新的问题
        changeVerifyCode();
        $('#captcha-img').click(function () {
            changeVerifyCode();
        });
    });

    //更改或者重新加载验证码
    function changeVerifyCode() {
//项目URL
        var adminUrl = $('#admin-url').val();
        $.ajax({
            //使用ajax请求site/captcha方法，加上refresh参数，接口返回json数据
            url: adminUrl + "?refresh",
            dataType: 'json',
            cache: false,
            success: function (data) {
                //将验证码图片中的图片地址更换
                $("#captcha-img").attr('src', data['url']);
            }
        });
    }

</script>