<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<?= Html::cssFile('@web/vendor/daterangepicker/daterangepicker.css') ?>
<?= Html::cssFile('@web/vendor/jquery-reveal/reveal.css') ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-title">
                客户计划
                <small>创建复盘</small>
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
                <a href="#">客户计划</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">创建复盘</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel">

                <div class="view">
                    <div class="tabbable">

                        <!-- Only required for left/right tabs -->
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#panel-807395" data-toggle="tab" contenteditable="true">
                                    <i class="creat-step">1</i>
                                    <i class="fa fa-bar-chart-o fa-fw"></i>
                                    设置参数
                                </a>
                            </li>
                            <li class="">
                                <a href="#panel-792912" data-toggle="tab" contenteditable="true">
                                    <i class="creat-step">2</i>
                                    <i class="fa fa-bar-chart-o fa-fw"></i>
                                    添加测略组
                                </a>
                            </li>
                            <li class="">
                                <a href="#panel-792912" data-toggle="tab" contenteditable="true">
                                    <i class="creat-step">3</i>
                                    <i class="fa fa-bar-chart-o fa-fw"></i>
                                    生成报表
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">

                            <div class="tab-pane active" id="panel-807395" contenteditable="true">
                                <div class="form-group form-inline">
                                    <div class="control-group">
                                        <span>复盘名称</span>
                                        <input type="text" class="form-control" placeholder="复盘名称">
                                    </div>

                                    <div class="control-group">
                                        <span>店铺选择</span>
                                        <input type="text" class="form-control" placeholder="店铺选择">
                                    </div>

                                    <div class="control-group">
                                        <span>时间选择</span>
                                        <input type="text" value="" class="form-control select-time" name="select-time">
                                    </div>

                                    <div class="control-group">
                                        <span>字段选择</span>
                                        <a href="#" data-reveal-id="field-select" data-animation="fade">
                                            <i class="fa fa-gear fa-fw"></i>
                                        </a>
                                    </div>

                                    <div class="control-group">
                                        <span>效果模型</span>
                                        <label class="form-inline">
                                            <input type="radio" value="1" checked="checked" name="group">点击效果
                                            <input type="radio" value="2" name="group">展示效果
                                        </label>
                                    </div>

                                    <div class="control-group">
                                        <span>数据周期</span>
                                        <label class="form-inline">
                                            <input type="radio" value="1" checked="checked" name="group">3天
                                            <input type="radio" value="2" name="group">7天
                                            <input type="radio" value="2" name="group">15天
                                        </label>
                                    </div>

                                    <input type="button" value="下一步，添加对比组" class="btn btn-primary">
                                </div>
                            </div>

                            <div class="tab-pane" id="panel-792912" contenteditable="true">
                                <div class="form-group form-inline">
                                    <div class="control-group">
                                        <span>复盘名称</span>
                                        <input type="text" class="form-control" placeholder="复盘名称">
                                    </div>

                                    <div class="control-group">
                                        <span>店铺选择</span>
                                        <input type="text" class="form-control" placeholder="店铺选择">
                                    </div>

                                    <div class="control-group">
                                        <span>时间选择</span>
                                        <input type="text" value="" class="form-control select-time" name="select-time">
                                    </div>

                                    <div class="control-group">
                                        <span>字段选择</span>
                                        <a href="#" data-reveal-id="field-select" data-animation="fade">
                                            <i class="fa fa-gear fa-fw"></i>
                                        </a>
                                    </div>

                                    <div class="control-group">
                                        <span>效果模型</span>
                                        <label class="form-inline">
                                            <input type="radio" value="1" checked="checked" name="group">点击效果
                                            <input type="radio" value="2" name="group">展示效果
                                        </label>
                                    </div>

                                    <div class="control-group">
                                        <span>数据周期</span>
                                        <label class="form-inline">
                                            <input type="radio" value="1" checked="checked" name="group">3天
                                            <input type="radio" value="2" name="group">7天
                                            <input type="radio" value="2" name="group">15天
                                        </label>
                                    </div>

                                    <input type="button" value="下一步，添加对比组" class="btn btn-primary">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

<!-- 字段选择 -->
<div id="field-select" class="reveal-modal">
    <div class="field-box-title col-lt-6">

        <div class="field-box-title-head">
            选择数据字段
        </div>

        <div class="field-box-title-center">
            <div class="form-group form-inline">

                <div class="control-group">
                    <span>消耗</span>
                    <label class="form-inline">
                        <input type="radio" value="1" checked="checked" name="group">消耗
                    </label>
                </div>

                <div class="control-group">
                    <span>触达</span>
                    <label class="form-inline">
                        <input type="radio" value="1" checked="checked" name="group">展现量
                    </label>
                </div>

                <div class="control-group">
                    <span>兴趣</span>
                    <label class="form-inline">
                        <input type="radio" value="1" checked="checked" name="group">点击量
                        <input type="radio" value="1" checked="checked" name="group">访客
                    </label>
                </div>

                <div class="control-group">
                    <span>意向</span>
                    <label class="form-inline">
                        <input type="radio" value="1" checked="checked" name="group">深度进店
                        <input type="radio" value="1" checked="checked" name="group">访问时长
                        <input type="radio" value="1" checked="checked" name="group">访问页面数
                    </label>
                </div>

                <div class="control-group">
                    <span>兴趣</span>
                    <label class="form-inline">
                        <input type="radio" value="1" checked="checked" name="group">点击量
                        <input type="radio" value="1" checked="checked" name="group">访客
                    </label>
                </div>

                <div class="control-group">
                    <span>行动</span>
                    <label class="form-inline">
                        <input type="radio" value="1" checked="checked" name="group">收藏宝贝量
                        <input type="radio" value="1" checked="checked" name="group">收藏店铺量
                        <input type="radio" value="1" checked="checked" name="group">添加购物车量
                        <input type="radio" value="1" checked="checked" name="group">拍下订单量
                        <input type="radio" value="1" checked="checked" name="group">拍下订单金额<br>
                        <input type="radio" value="1" checked="checked" name="group">商品收藏率
                        <input type="radio" value="1" checked="checked" name="group">商品加购率
                        <input type="radio" value="1" checked="checked" name="group">商品收藏成本
                        <input type="radio" value="1" checked="checked" name="group">商品加购成本
                        <input type="radio" value="1" checked="checked" name="group">商品收藏加购成本
                    </label>
                </div>

                <div class="control-group">
                    <span>成交</span>
                    <label class="form-inline">
                        <input type="radio" value="1" checked="checked" name="group">成交订单量
                        <input type="radio" value="1" checked="checked" name="group">成交订单金额
                        <input type="radio" value="1" checked="checked" name="group">订单平均成本
                        <input type="radio" value="1" checked="checked" name="group">订单平均金额
                    </label>
                </div>

                <div class="control-group">
                    <span>衍生指标</span>
                    <label class="form-inline">
                        <input type="radio" value="1" checked="checked" name="group">千次展现成本
                        <input type="radio" value="1" checked="checked" name="group">点击率
                        <input type="radio" value="1" checked="checked" name="group">点击单价
                        <input type="radio" value="1" checked="checked" name="group">点击转化率
                        <input type="radio" value="1" checked="checked" name="group">投资回报率
                    </label>
                </div>

            </div>
        </div>
    </div>
    <div class="field-box-title col-lt-6">
        <div class="field-box-title-head">
            自定义字段
        </div>

        <div class="field-box-title-center">
            <div class="form-group form-inline">

                <div class="control-group">
                    <span>可拖动排序</span>
                    <input type="button" value="清空" class="btn btn-primary pull-right">
                </div>

                <div class="control-group">
                    <ul class="list-group custom-fields">
                        <li class="list-group-item">消耗</li>
                        <li class="list-group-item">展现量</li>
                        <li class="list-group-item">点击量</li>
                        <li class="list-group-item">访客</li>
                        <li class="list-group-item">收藏宝贝量</li>
                        <li class="list-group-item">收藏店铺量</li>
                        <li class="list-group-item">添加购物车量</li>
                        <li class="list-group-item">投资回报率</li>
                        <li class="list-group-item">千次展现成本</li>
                        <li class="list-group-item">点击率</li>
                        <li class="list-group-item">点击单价</li>
                        <li class="list-group-item">点击转化率</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <a class="close-reveal-modal">&#215;</a>
</div>

<?= Html::jsFile('@web/vendor/daterangepicker/moment.js') ?>
<?= Html::jsFile('@web/vendor/daterangepicker/daterangepicker.js') ?>


<!-- 弹出层 reveal.js -->
<?= Html::jsFile('@web/vendor/jquery-reveal/jquery.reveal.js') ?>
<!-- 拖动 jquery-sortable.js -->
<?= Html::jsFile('@web/vendor/jquery-sortable/jquery-sortable.js') ?>
<script>

    // 时间段选择
    var cb = function (start, end, label) {
        $('.select-time span').html(start.format('YYYY-MM-DD HH:mm:ss'));
    };

    var optionSet = {
        'startDate': moment().hours(4).minutes(0).seconds(0),
        'endDate': moment().endOf('day'),
        'timePicker': true,
        'ranges': {
            // '最近1小时': [moment().subtract('hours',1), moment()],
            '今天': [moment().startOf('day'), moment()],
            '昨天': [moment().subtract(1, 'days').startOf('day'), moment().subtract(1, 'days').endOf('day')],
            '7天': [moment().subtract(7, 'days').startOf('day'), moment().endOf('day')],
            '15天': [moment().subtract(15, 'days').startOf('day'), moment().endOf('day')],
            '30天': [moment().subtract(30, 'days').startOf('day'), moment().endOf('day')],
            '这个月': [moment().startOf('month').startOf('day'), moment().endOf('month').endOf('day')],
            '上个月': [moment().subtract(1, 'month').startOf('month').startOf('day'), moment().subtract(1, 'month').endOf('month').endOf('day')]
        },
        'locale': {
            'format': 'YYYY-MM-DD HH:mm:ss',
            "separator": " - ",
            "applyLabel": "确定",
            "cancelLabel": "取消",
            "fromLabel": "起始时间",
            "toLabel": "结束时间'",
            "customRangeLabel": "自定义",
            "weekLabel": "W",
            'daysOfWeek': ['日', '一', '二', '三', '四', '五', '六'],
            'monthNames': ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
        },
        'opens': 'right',
        'drops': 'down',
        'format': 'YYYY-MM-DD HH:mm:ss',
    };
    $('.select-time').daterangepicker(optionSet, cb);

    // 拖动排序
    $('ul.custom-fields').sortable();
</script>