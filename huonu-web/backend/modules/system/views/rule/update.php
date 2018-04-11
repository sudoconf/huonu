<?php

use yii\helpers\Html;

/* @var $this  yii\web\View */

$this->title = Yii::t('admin', 'Update Rule') . ': ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Rules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->name]];
$this->params['breadcrumbs'][] = Yii::t('admin', 'Update');
?>
<div id="page-wrapper">

    <div class="row">

        <div class="auth-item-update">

            <h1><?= Html::encode($this->title) ?></h1>
            <?=
            $this->render('_form', [
                'model' => $model,
            ]);
            ?>
        </div>

    </div>
</div>