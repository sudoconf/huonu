<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $context backend\modules\system\controllers\ItemController */

$this->title = '创建角色';

$context = $this->context;
$labels = $context->labels();
$this->title = Yii::t('admin', 'Create ' . $labels['Item']);
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', $labels['Items']), 'url' => ['index']];
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
