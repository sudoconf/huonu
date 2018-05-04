<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\searchs\ApiLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'api 调用日志';
$this->params['breadcrumbs'][] = $this->title;
?>

<?= Html::cssFile('@web/vendor/daterangepicker/daterangepicker.css') ?>

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

        <div class="api-logs-index col-lg-12">

            <?php echo $this->render('_search', ['model' => $searchModel]); ?>

            <div class="panel-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    // 'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'api_name',
                        'created_at',
                        'call_poeple',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => '调用的次数',
                            'template' => '{number}',
                            'buttons' => [
                                'number' => function ($url, $model, $key) {
                                    return $model->callNumber;
                                },
                            ],
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => '更多操作',
                            'template' => '{sync}',
                            'buttons' => [
                                'sync' => function ($url, $model, $key) {
                                    return Html::button('查看详情', [
                                        'class' => 'btn btn-primary log-info',
                                        'data-loading-text' => 'Loading...',
                                        'value' => $model->id,
                                        'data-url' => Url::toRoute('api-log/ajax-get-log')
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

<?= Html::jsFile('@web/vendor/daterangepicker/moment.js') ?>
<?= Html::jsFile('@web/vendor/daterangepicker/daterangepicker.js') ?>

<script>

    $('.reset').click(function () {
        $('.select-time').val('');
        $('#startAt').val('');
        $('#endAt').val('');
    });

    // 时间段选择
    var cb = function (start, end, label) {
        // 赋值给隐藏输入框
        $('#startAt').val(start.format('YYYY-MM-DD'));
        $('#endAt').val(end.format('YYYY-MM-DD'));
    };
    var optionSet = {
        'ranges': {
            '今天': [moment().startOf('day'), moment()],
            '昨天': [moment().subtract(1, 'days').startOf('day'), moment().subtract(1, 'days').endOf('day')],
            '7天': [moment().subtract(7, 'days').startOf('day'), moment().endOf('day')],
            '15天': [moment().subtract(15, 'days').startOf('day'), moment().endOf('day')],
        },
        'locale': {
            'format': 'YYYY-MM-DD',
            "separator": " 至 ",
            "applyLabel": "确定",
            "cancelLabel": "取消",
            "fromLabel": "起始时间",
            "toLabel": "结束时间'",
            "customRangeLabel": "自定义",
            "weekLabel": "W",
            'daysOfWeek': ['日', '一', '二', '三', '四', '五', '六'],
            'monthNames': ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
        },
    };
    $('.select-time').daterangepicker(optionSet, cb);

    $('.log-info').click(function () {

        $(this).button('loading').delay(1000).queue(function () {
            $(this).button('reset');
            $(this).dequeue();
        });

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

                var html = '<div class="layer-form-log-info"><div class="layer-form"><div class="form-group"><label class="control-label">api 名称</label><input type="text" class="form-control" value="' + msg.data.api_name + '" readonly><p class="help-block"></p></div>';
                html += '<div class="form-group"><label class="control-label">调用时间</label><input type="text" class="form-control" value="' + msg.data.created_at + '" readonly><p class="help-block"></p></div>';

                html += '<div class="form-group"><label class="control-label">调用人</label><input type="text" class="form-control" value="' + msg.data.call_poeple + '" readonly><p class="help-block"></p></div></div></div>';
                layer.open({
                    type: 1,
                    title: 'api 日志调用详情',
                    shadeClose: true,
                    shade: 0.5, // 遮罩
                    anim: 1, // 动画
                    maxmin: false, //开启最大化最小化按钮
                    area: ['500px', '400px'],
                    content: html,
                });

            },
            error: function (e, jqxhr, settings, exception) {
                LAYER_MSG_FUNCTION('加载失败！', 2, i);
            }
        });

    });

</script>