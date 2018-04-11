<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var mdm\admin\models\AuthItem $model
 */
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Rules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="page-wrapper">

    <div class="row">

        <div class="auth-item-view">

            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                <?= Html::a(Yii::t('admin', 'Update'), ['update', 'id' => $model->name], ['class' => 'btn btn-primary']) ?>
                <?php
                echo Html::a(Yii::t('admin', 'Delete'), ['delete', 'id' => $model->name], [
                    'class' => 'btn btn-danger',
                    'data-confirm' => Yii::t('admin', 'Are you sure to delete this item?'),
                    'data-method' => 'post',
                ]);
                ?>
            </p>

            <?php
            echo DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'name',
                    'className',
                ],
            ]);
            ?>
        </div>

    </div>
</div>