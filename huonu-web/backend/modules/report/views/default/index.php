<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\searchs\MultitraySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '人群复盘列表';
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
        </ul>
    </div>

    <div class="row">
        <div class="col-lg-12">

            <?= $this->render('_search', ['model' => $searchModel]); ?>

            <div class="control-group">
                <?= Html::a('新建定向人群复盘', ['create'], ['class' => 'btn btn-primary']) ?>
            </div>

            <div class="control-group">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    // 'filterModel' => $searchModel,
                    // 'pager' => [
                    //     // 'options' => [
                    //     //     'class' => 'hidden' //关闭自带分页
                    //     // ],
                    //     'firstPageLabel' => '首页',
                    //     'prevPageLabel' => '上一页',
                    //     'nextPageLabel' => '下一页',
                    //     'lastPageLabel' => '末页',
                    // ],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'taobao_id',
                        'taobao_name',
                        'multitray_name',
                        [
                            'attribute' => 'multitray_start_time',
                            'format' => ['date', 'php:Y-m-d'],
                        ],
                        [
                            'attribute' => 'multitray_end_time',
                            'format' => ['date', 'php:Y-m-d'],
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
                                return $dataProvider->multitray_cycle . '天';
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
                                    $url = Url::toRoute(['show', 'multitrayId' => $model->multitray_id]);
                                    return Html::a('<span class="btn btn-primary">查看</span>', $url, ['title' => '查看', 'class' => 'mr10']);
                                },
                                'delete' => function ($url, $model, $key) {
                                    return Html::button('删除', [
                                        'class' => 'btn btn-primary delete-report',
                                        'value' => $model->multitray_id
                                    ]);
                                },
                            ],
                        ],
                    ],
                ]); ?>
            </div>
        </div>

    </div>
</div>

<script>
    $(function () {
        // ajax 删除 复盘
        $('.delete-report').click(function () {

            var multitrayId = $(this).val();

            $.ajax({
                url: 'default/ajax-delete.html',
                type: 'get',
                data: {'multitrayId': multitrayId},
                dataType: 'json',
                beforeSend: function () {
                    i = SHOW_LOAD_LAYER();
                },
                success: function (response) {
                    CLOSE_LOAD_LAYER(i);

                    if (response.result == "true") {

                        layer.msg('删除成功', {
                            icon: 2,
                            shade: [0.5],
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        }, function () {

                            CLOSE_LOAD_LAYER(i);

                            window.location.href = 'default.html';
                        });
                    } else {
                        LAYER_MSG_FUNCTION('加载失败', i);
                    }

                },
                error: function (e, jqxhr, settings, exception) {
                    LAYER_MSG_FUNCTION('加载失败', i);
                }
            });
        })
    });
</script>