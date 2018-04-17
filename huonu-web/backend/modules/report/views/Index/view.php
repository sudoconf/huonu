<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Multitray */

$this->title = $model->multitray_id;
$this->params['breadcrumbs'][] = ['label' => 'Multitrays', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="multitray-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->multitray_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->multitray_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'multitray_id',
            'taobao_id',
            'taobao_name',
            'multitray_name',
            'multitray_start_time:datetime',
            'multitray_end_time:datetime',
            'multitray_effect_model',
            'multitray_cycle',
            'multitray_field',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
