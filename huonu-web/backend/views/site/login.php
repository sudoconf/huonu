<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '智行智投 - 用户登录';
$this->params['breadcrumbs'][] = $this->title;
$this->registerMetaTag(['name' => 'keywords', 'content' => '登录']);
$this->registerMetaTag(['name' => 'description', 'content' => '登录'], 'description');
?>
<?= Html::cssFile('@web/css/login.css') ?>
<div class="login">

    <?php $form = ActiveForm::begin(); ?>
    <center><img id="logo" src="http://buy.cmseasy.cn/resources/images/logo.png"/></center>

    <div class="clear"></div>

    <div class="form-group">
        <?= $form->field($model, 'username')->textInput(['placeholder' => $model->getAttributeLabel('username'), 'autofocus' => true])->label(false) ?>
    </div>

    <div class="form-group">
        <?= $form->field($model, 'password')->passwordInput(['placeholder' => $model->getAttributeLabel('password')])->label(false) ?>
    </div>

    <!--      <div class="form-group">-->
    <!--        <input class="form-control" style="width: 150px; display: inline-block;" placeholder="请输入验证码" name="captcha" type="text">-->
    <!--        <img src="index.php?r=login/captcha" alt="验证码" align="bottom" style="cursor:pointer;" title="看不清可单击图片刷新" onclick="this.src='index.php?r=login/captcha&d='+Math.random();" />-->
    <!--      </div>-->

    <!--<div class="form-group">-->
    <!--  <label>-->
    <?php //$form->field($model, 'rememberMe')->checkbox() ?>
    <!--  </label>-->
    <!--</div>-->

    <button type="submit" class="btn btn-primary" name="login-button">登录</button>
    <?php ActiveForm::end(); ?>

    <div class="clear"></div>
    <div class="copyright">© 火奴软件</div>

</div>
