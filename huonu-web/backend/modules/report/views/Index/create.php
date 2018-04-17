<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Multitray */

$this->title = 'Create Multitray';
$this->params['breadcrumbs'][] = ['label' => 'Multitrays', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="multitray-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
