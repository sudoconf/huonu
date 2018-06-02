<?php

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= Url::to('@web/favicon.ico') ?>" type="image/x-icon"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <!-- jQuery -->
    <?= Html::jsFile('@web/vendor/jquery/1.10.2/jquery.min.js') ?>

    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div id="wrapper">

    <?= $this->render('left-top-menu'); ?>

    <?= $content ?>

</div>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
