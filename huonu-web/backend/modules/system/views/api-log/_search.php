<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\searchs\ApiLogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel-body form-group form-inline api-logs-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="form-group">
        <span>时间选择</span>
        <input type="text" placeholder="请选择时间" class="form-control select-time">
        <input type="hidden" name="startAt" id="startAt" value="<?= $model->getAttribute('endAt') ?>"/>
        <input type="hidden" name="endAt" id="endAt" value="<?= $model->getAttribute('endAt') ?>"/>
    </div>

    <div class="form-group">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
        <?= Html::Button('重置', ['class' => 'btn btn-default reset']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>