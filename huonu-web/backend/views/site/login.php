<?php
use yii\helpers\Html;

$this->title = '智行智投 - 用户登录';
$this->params['breadcrumbs'][] = $this->title;
$this->registerMetaTag(['name' => 'keywords', 'content' => '登录']);
$this->registerMetaTag(['name' => 'description', 'content' => '登录'], 'description');
?>
<?= Html::cssFile('@web/css/login.css')?>
<div class="login">

  <form id="login-form" action="index.php?r=site/login" method="post">
      <center><img id="logo" src="http://buy.cmseasy.cn/resources/images/logo.png" /></center>

      <div class="clear"></div>

      <div class="form-group">
        <input class="form-control" placeholder="请输入用户名" name="username" type="text" autofocus>
      </div>

      <div class="form-group">
        <input class="form-control" placeholder="请输入密码" name="password" type="password">
      </div>

<!--      <div class="form-group">-->
<!--        <input class="form-control" style="width: 150px; display: inline-block;" placeholder="请输入验证码" name="captcha" type="text">-->
<!--        <img src="index.php?r=login/captcha" alt="验证码" align="bottom" style="cursor:pointer;" title="看不清可单击图片刷新" onclick="this.src='index.php?r=login/captcha&d='+Math.random();" />-->
<!--      </div>-->

      <!--<div class="form-group">-->
      <!--  <label>-->
      <!--    记住我<input width="10px" name="remember" type="checkbox" value="1">-->
      <!--  </label>-->
      <!--</div>-->

      <input type="hidden" id="_csrf" name="<?php echo Yii::$app->request->csrfParam;?>" value="<?php echo yii::$app->request->csrfToken?>">
      <button type="submit" class="btn btn-primary" name="login-button">登录</button>
  </form>

  <div class="clear"></div>
  <div class="copyright">© 火奴软件</div>

</div>
