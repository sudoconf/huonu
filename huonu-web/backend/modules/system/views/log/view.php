<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminLog */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Admin Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div id="page-wrapper">

    <div class="row">
        <div class="admin-log-view">

            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
                    'id',
                    'type',
                    'controller',
                    'action',
                    'url:url',
                    'index',
                    'params:ntext',
                    'ip',
                    'admin_agent',
                    'created_at',
                    'created_id',
                ],
            ]) ?>

        </div>
    </div>
</div>