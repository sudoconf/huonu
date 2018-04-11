<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\AuthItem */
/* @var $context backend\modules\system\controllers\ItemController */

$context = $this->context;
$labels = $context->labels();
$this->title = Yii::t('admin', 'Update ' . $labels['Item']) . ': ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', $labels['Items']), 'url' => ['index']];
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
