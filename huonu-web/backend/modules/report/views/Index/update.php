<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Multitray */

$this->title = 'Update Multitray: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Multitrays', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->multitray_id, 'url' => ['view', 'id' => $model->multitray_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="multitray-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
