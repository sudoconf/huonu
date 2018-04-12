<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */

/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>

<div id="page-wrapper">

    <div class="row">

        <div class="site-error">

            <h1><?= Html::encode($this->title) ?></h1>

            <div class="alert alert-danger">
                <?= nl2br(Html::encode($message)) ?>
            </div>

            <p>
                上面的错误发生在Web服务器处理您的请求的时候.
            </p>
            <p>
                如果您认为这是一个服务器错误，请与我们联系. 谢谢你.
            </p>

        </div>

    </div>
</div>
