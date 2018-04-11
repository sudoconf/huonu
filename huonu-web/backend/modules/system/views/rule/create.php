<?php

use yii\helpers\Html;

/* @var $this  yii\web\View */

$this->title = Yii::t('admin', 'Create Rule');
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Rules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="page-wrapper">

    <div class="row">

        <div class="auth-item-create">

            <h1><?= Html::encode($this->title) ?></h1>

            <?=
            $this->render('_form', [
                'model' => $model,
            ]);
            ?>

        </div>

    </div>
</div>