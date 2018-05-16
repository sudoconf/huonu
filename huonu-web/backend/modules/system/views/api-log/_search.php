<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\searchs\ApiLogSearch */
/* @var $form yii\widgets\ActiveForm */

$startAt = !($model->getAttribute('startAt')) ? date('Y-m-d 00:00:00') : $model->getAttribute('startAt');
$endAt = !($model->getAttribute('endAt')) ? date('Y-m-d 23:59:59') : $model->getAttribute('endAt');

$vStartAt = date('Y-m-d', strtotime($startAt));
$vEndAt = date('Y-m-d', strtotime($endAt));

?>

<div class="panel-body form-group form-inline">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="form-group">
        <span class="mr10">时间选择：</span>
        <input type="text" placeholder="请选择时间" class="form-control select-time"
               value="<?= $vStartAt . ' 至 ' . $vEndAt ?>">
        <input type="hidden" name="startAt" id="startAt" value="<?= $startAt ?>"/>
        <input type="hidden" name="endAt" id="endAt" value="<?= $endAt ?>"/>
    </div>

    <div class="form-group">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
        <?= Html::Button('重置', ['class' => 'btn btn-default reset']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>