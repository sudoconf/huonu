<?php

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = '客户报表 - 数据同步';
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-title">
                客户报表
                <small>数据同步</small>
            </h3>
        </div>
    </div>

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="index.html">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">客户报表</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">数据同步</a>
            </li>
        </ul>
    </div>

    <div class="row col-lg-12">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'taobao_user_id',
                'taobao_user_nick',
                'sync_status',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => '更多操作',
                    'template' => '{sync}',
                    'buttons' => [
                        'sync' => function ($url, $model, $key) {
                            return Html::button('手动同步', [
                                'class' => 'btn btn-primary manual-sync',
                                'data-loading-text' => 'Loading...'
                            ]);
                        },
                    ],
                ],
            ],
        ]); ?>
    </div>
</div>

<script>

    $('.manual-sync').click(function () {

        $(this).button('loading').delay(1000).queue(function () {
            $(this).button('reset');
            $(this).dequeue();
        });

    });

</script>