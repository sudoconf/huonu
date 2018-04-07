<?php

use backend\assets\AppAsset;
use yii\helpers\Html;

// AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <?= Html::cssFile('@web/vendor/bootstrap/css/bootstrap.min.css') ?>

    <!-- MetisMenu CSS -->
    <?= Html::cssFile('@web/vendor/metisMenu/metisMenu.min.css') ?>

    <?= Html::cssFile('@web/css/hn-admin.css') ?>

    <!-- Custom Fonts -->
    <?= Html::cssFile('@web/vendor/font-awesome/css/font-awesome.min.css') ?>

    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div id="wrapper">

  <?= $content ?>

</div>


<?php $this->endBody() ?>

<!-- jQuery -->
<?= Html::jsFile('@web/vendor/jquery/jquery.min.js')?>

<!-- Bootstrap Core JavaScript -->
<?= Html::jsFile('@web/vendor/bootstrap/js/bootstrap.min.js')?>

<!-- Metis Menu Plugin JavaScript -->
<?= Html::jsFile('@web/vendor/metisMenu/metisMenu.min.js')?>

<!-- Custom Theme JavaScript -->
<?= Html::jsFile('@web/js/hn-admin.js')?>

<!-- Custom Theme JavaScript -->
<?= Html::jsFile('@web/vendor/layer/layer.js')?>

</body>
</html>
<?php $this->endPage() ?>
