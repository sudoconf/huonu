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

    <?= Html::cssFile('@web/vendor/bootstrap/css/bootstrap.min.css')?>
    <?= Html::cssFile('@web/css/login.css') ?>
</head>

<div class="login">

    <?php $form = ActiveForm::begin(); ?>
  <center><img id="logo" src="http://buy.cmseasy.cn/resources/images/logo.png"/></center>

  <div class="clear"></div>

    <?= $form->field($model, 'username')->textInput(['placeholder' => $model->getAttributeLabel('username'), 'autofocus' => true])->label(false) ?>

    <?= $form->field($model, 'password')->passwordInput(['placeholder' => $model->getAttributeLabel('password')])->label(false) ?>

  <div class="form-group form-inline">
      <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
          'template' => '<div class="row"><div class="col-lg-4">{image}</div><div class="col-lg-8">{input}</div></div>',
      ]) ?>
  </div>

    <?= $form->field($model, 'rememberMe')->checkbox() ?>
    <?= $form->field($model, 'rememberMe')->checkbox() ?>

  <button type="submit" class="btn btn-primary" name="login-button">登录</button>
    <?php ActiveForm::end(); ?>

  <div class="clear"></div>
  <div class="copyright">© 火奴软件</div>

</div>
