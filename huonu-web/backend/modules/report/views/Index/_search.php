<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\searchs\MultitraySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="multitray-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'multitray_id') ?>

    <?= $form->field($model, 'taobao_id') ?>

    <?= $form->field($model, 'taobao_name') ?>

    <?= $form->field($model, 'multitray_name') ?>

    <?= $form->field($model, 'multitray_start_time') ?>

    <?php // echo $form->field($model, 'multitray_end_time') ?>

    <?php // echo $form->field($model, 'multitray_effect_model') ?>

    <?php // echo $form->field($model, 'multitray_cycle') ?>

    <?php // echo $form->field($model, 'multitray_field') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
