<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\searchs\MultitraySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Multitrays';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="multitray-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Multitray', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'multitray_id',
            'taobao_id',
            'taobao_name',
            'multitray_name',
            'multitray_start_time:datetime',
            //'multitray_end_time:datetime',
            //'multitray_effect_model',
            //'multitray_cycle',
            //'multitray_field',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
