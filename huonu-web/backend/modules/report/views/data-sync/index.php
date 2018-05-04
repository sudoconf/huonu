<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\searchs\TaobaoAuthorizeUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '客户报表 - 数据同步';
$this->params['breadcrumbs'][] = $this->title;
?>


<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-title">
                客户报表
                <small><?= Html::encode($this->title) ?></small>
            </h3>
        </div>
    </div>

    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="<?= Url::toRoute('/site') ?>">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="<?= Url::toRoute('index') ?>">客户报表</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">数据同步</a>
            </li>
        </ul>
    </div>
    <div class="taobao-authorize-user-index">

        <?php echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            // 'filterModel' => $searchModel,
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
            // $(this).button('reset');
            // $(this).dequeue();
        });

    });

</script>