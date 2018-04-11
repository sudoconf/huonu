<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $context backend\modules\system\controllers\ItemController */

$context = $this->context;
$labels = $context->labels();
$this->title = $labels['Items'];

$this->params['breadcrumbs'][] = $this->title;

?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-title">
                系统管理
                <small>角色</small>
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
                <a href="javascript:;">角色管理</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:;">角色列表</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">

                <div class="panel-body">
                    <?= Html::a(Yii::t('admin', 'Create ' . $labels['Item']), ['create'], ['class' => 'btn btn-success']) ?>
                </div>

                <div class="panel-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        // 'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                                'attribute' => '名称',
                                'content' => function ($dataProvider) {
                                    return $dataProvider->name;
                                },
                            ],
                            [
                                'attribute' => '规则名称',
                                'content' => function ($dataProvider) {
                                    return $dataProvider->ruleName;
                                },
                            ],
                            [
                                'attribute' => '描述',
                                'content' => function ($dataProvider) {
                                    return $dataProvider->description;
                                },
                            ],
                            ['class' => 'yii\grid\ActionColumn',],
                        ],
                        'emptyText' => '没有筛选到任何内容哦',
                    ]); ?>
                </div>

            </div>
        </div>
    </div>

</div>
<!-- /#page-wrapper -->
