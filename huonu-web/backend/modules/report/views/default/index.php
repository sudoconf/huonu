<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\searchs\MultitraySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '复盘';
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="page-wrapper">

    <div class="row">
        <div class="multitray-index">

            <h1><?= Html::encode($this->title) ?></h1>
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <?= Html::a('新建定向人群复盘', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                // 'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'taobao_id',
                    'taobao_name',
                    'multitray_name',
                    [
                        'attribute' => 'multitray_start_time',
                        'format' => ['date', 'php:Y-m-d H:i:s'],
                    ],
                    [
                        'attribute' => 'multitray_end_time',
                        'format' => ['date', 'php:Y-m-d H:i:s'],
                    ],
                    [
                        'attribute' => 'multitray_effect_model',
                        'value' => function ($model) {
                            return $model->multitray_effect_model == 'click_effect' ? '点击效果' : '展示效果';
                        },
                    ],
                    [
                        'attribute' => 'multitray_cycle',
                        'content' => function ($dataProvider) {
                            return $dataProvider->multitray_cycle.'天';
                        },
                    ],
                    [
                        'attribute' => 'created_at',
                        'format' => ['date', 'php:Y-m-d H:i:s'],
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => '更多操作',
                        'template' => '{info}{delete}',
                        'buttons' => [
                            'info' => function ($url, $model, $key) {
                                return Html::button('查看', [
                                    'class' => 'btn btn-primary reset-password'
                                ]);
                            },
                            'delete' => function ($url, $model, $key) {
                                return Html::button('删除', [
                                    'class' => 'btn btn-primary reset-password'
                                ]);
                            },
                        ],
                    ],
                ],
            ]); ?>
        </div>

    </div>
</div>
