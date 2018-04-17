<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Multitray */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="multitray-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'taobao_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'taobao_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'multitray_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'multitray_start_time')->textInput() ?>

    <?= $form->field($model, 'multitray_end_time')->textInput() ?>

    <?= $form->field($model, 'multitray_effect_model')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'multitray_cycle')->textInput() ?>

    <?= $form->field($model, 'multitray_field')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
