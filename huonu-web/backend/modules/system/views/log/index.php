<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use \backend\models\SystemLog;
use \yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\searchs\AdminLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '日志记录';
$this->params['breadcrumbs'][] = $this->title;
?>


<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-title">
                系统管理
                <small></small>
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
                <a href="#">系统管理</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#"><?= $this->title ?></a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="admin-log-index col-lg-12">

            <?php Pjax::begin(); ?>
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                // 'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'username',
                    [
                        'attribute' => 'type',
                        'value' => function ($model) {
                            return SystemLog::getTypeDescription($model->type);
                        },
                    ],
                    'module',
                    'controller',
                    'action',
                    // 'url:url',
                    'url',
                    // 'params',
                    'ip',
                    // 'agent',
                    [
                        'attribute' => 'created_at',
                        'format' => ['date', 'php:Y-m-d H:i:s'],
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => '更多操作',
                        'template' => '{info}',
                        'buttons' => [
                            'info' => function ($url, $model, $key) {
                                return Html::button('详情', [
                                    'class' => 'btn btn-primary logo-info',
                                    'value' => $model->id,
                                    'data-url' => Url::toRoute('log/ajax-get-log')
                                ]);
                            },
                        ],
                    ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>

    </div>
</div>

<script>
    $('.logo-info').on('click', function () {
        var id = this.value;
        var ajaxUrl = $(this).attr("data-url");
        $.ajax({
            url: ajaxUrl,
            type: 'get',
            data: {'id': id},
            beforeSend: function () {
                i = SHOW_LOAD_LAYER();
            },
            success: function (msg) {
                CLOSE_LOAD_LAYER(i);
                console.log(msg);
                var html = '<div class="layer-form-log-info"><div class="layer-form"><div class="form-group"><label class="control-label">操作用户</label><input type="text" class="form-control" value="' + msg.data.username + '" readonly><p class="help-block"></p></div>';
                html += '<div class="form-group"><label class="control-label">日志类型</label><input type="text" class="form-control" value="' + msg.data.type + '" readonly><p class="help-block"></p></div>';

                html += '<div class="form-group"><label class="control-label">模块</label><input type="text" class="form-control" value="' + msg.data.module + '" readonly><p class="help-block"></p></div>';

                html += '<div class="form-group"><label class="control-label">控制器</label><input type="text" class="form-control" value="' + msg.data.controller + '" readonly><p class="help-block"></p></div>';

                html += '<div class="form-group"><label class="control-label">方法</label><input type="text" class="form-control" value="' + msg.data.action + '" readonly><p class="help-block"></p></div>';

                html += '<div class="form-group"><label class="control-label">请求地址</label><input type="text" class="form-control" value="' + msg.data.url + '" readonly><p class="help-block"></p></div>';

                html += "<div class='form-group'><label class='control-label'>请求参数</label><textarea class='form-control' readonly>" + msg.data.params + "</textarea><p class='help-block'></p></div>";

                html += '<div class="form-group"><label class="control-label">操作用户IP</label><input type="text" class="form-control" value="' + msg.data.ip + '" readonly><p class="help-block"></p></div>';

                html += "<div class='form-group'><label class='control-label'>操作用户浏览器代理商</label><textarea class='form-control' readonly>" + msg.data.agent + "</textarea><p class='help-block'></p></div>";

                html += '<div class="form-group"><label class="control-label">创建时间</label><input type="text" class="form-control" value="' + msg.data.createdAt + '" readonly><p class="help-block"></p></div></div></div>';
                layer.open({
                    type: 1,
                    title: '日志详情',
                    shadeClose: true,
                    shade: 0.5, // 遮罩
                    anim: 1, // 动画
                    maxmin: false, //开启最大化最小化按钮
                    area: ['800px', '430px'],
                    content: html,
                });

            },
            error: function (e, jqxhr, settings, exception) {
                layer.msg('加载失败！', {
                    icon: 2,
                    time: 2000 //2秒关闭（如果不配置，默认是3秒）
                }, function () {
                    CLOSE_LOAD_LAYER(i);
                });
            }
        });
    });
</script>