<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\SystemLog;

/* @var $this yii\web\View */
/* @var $model backend\models\searchs\LogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel-body form-group form-inline">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <div class="form-group">
        <?= $form->field($model, 'type')->dropDownList(SystemLog::getTypeDescription(), ['prompt' => '请选择']) ?>

        <?= $form->field($model, 'module') ?>

        <?= $form->field($model, 'controller') ?>

        <?= $form->field($model, 'action') ?>

    </div>

    <div class="form-group">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>