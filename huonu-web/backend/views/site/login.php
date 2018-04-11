<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

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

    <?= Html::cssFile('@web/vendor/bootstrap/css/bootstrap.min.css')?>
    <?= Html::cssFile('@web/css/login.css') ?>
</head>

<div class="login">

    <?php $form = ActiveForm::begin(); ?>
  <center><img id="logo" src="http://buy.cmseasy.cn/resources/images/logo.png"/></center>

  <div class="clear"></div>

    <?= $form->field($model, 'username')->textInput(['placeholder' => $model->getAttributeLabel('username'), 'autofocus' => true])->label(false) ?>

    <?= $form->field($model, 'password')->passwordInput(['placeholder' => $model->getAttributeLabel('password')])->label(false) ?>

  <!--<div class="form-group">-->
  <!--  <input class="form-control" style="width: 150px; display: inline-block;" placeholder="请输入验证码" name="captcha" type="text">-->
  <!--  <img src="--><?//=\yii\helpers\Url::toRoute('')?><!--" alt="验证码" align="bottom" style="cursor:pointer;" title="看不清可单击图片刷新" onclick="this.src='index.php?r=login/captcha&d='+Math.random();" />-->
  <!--</div>-->

    <?= $form->field($model, 'rememberMe')->checkbox() ?>

  <button type="submit" class="btn btn-primary" name="login-button">登录</button>
    <?php ActiveForm::end(); ?>

  <div class="clear"></div>
  <div class="copyright">© 火奴软件</div>

</div>
