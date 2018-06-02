<?php

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = '客户报表 - 新建复盘';

?>
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

                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active">
                                <a href="#set-up-parameters" data-toggle="tab" data-placement="top" title="设置参数">
                                    <!--去掉 data-toggle="tab" 就不能切换了-->
                                    <i class="create-step">1</i>
                                    <i class="fa fa-wrench"></i>
                                    设置参数
                                </a>
                            </li>
                            <li class="disabled">
                                <a href="#add-survey-group" data-toggle="tab" data-placement="top" title="添加测略组">
                                    <i class="create-step">2</i>
                                    <i class="fa fa-align-justify"></i>
                                    添加测略组
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">

                            <!-- 设置参数 -->
                            <?= $this->render('set_parameter', ['setParameter' => $setParameter]); ?>

                            <!-- 添加策略组 -->
                            <?= $this->render('add_survey_group', ['strategyGroup' => $strategyGroup]); ?>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

<?= Html::cssFile('@web/vendor/jquery-ui/jquery-ui.css') ?>
<?= Html::jsFile('@web/vendor/jquery-ui/jquery-ui.js') ?>
<?= Html::cssFile('@web/vendor/daterangepicker/daterangepicker.css') ?>
<?= Html::jsFile('@web/vendor/daterangepicker/moment.js') ?>
<?= Html::jsFile('@web/vendor/daterangepicker/daterangepicker.js') ?>
<?= Html::jsFile('@web/vendor/layer/layer.js') ?>
<?= Html::jsFile('@web/js/report/report.js') ?>

<script>
    // 时间段选择
    var cb = function (start, end, label) {
        //赋值给隐藏输入框
        $('input[name="multitray_start_time"]').val(start.format('YYYY-MM-DD'));
        $('input[name="multitray_end_time"]').val(end.format('YYYY-MM-DD'));
    };
    var optionSet = {
        'startDate': moment().startOf('day'), // 默认开始时间
        'endDate': moment().add(15, 'd').endOf('day'), // 默认结束时间
        'maxDate': moment().startOf('day'),
        'ranges': {
            '今天': [moment().startOf('day'), moment()],
            '昨天': [moment().subtract(1, 'days').startOf('day'), moment().subtract(1, 'days').endOf('day')],
            '7天': [moment().subtract(7, 'days').startOf('day'), moment().endOf('day')],
            '15天': [moment().subtract(15, 'days').startOf('day'), moment().endOf('day')],
            '30天': [moment().subtract(30, 'days').startOf('day'), moment().endOf('day')],
            '近一个月': [moment().subtract(1, 'month').startOf('month').startOf('day'), moment().subtract(1, 'month').endOf('month').endOf('day')],
            '近俩个月': [moment().subtract(2, 'month').startOf('month').startOf('day'), moment().subtract(1, 'month').endOf('month').endOf('day')],
            '近三个月': [moment().subtract(3, 'month').startOf('month').startOf('day'), moment().subtract(1, 'month').endOf('month').endOf('day')]
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

    $('input[name="taobao_name"]').autocomplete({
        minChars: 0,
        max: 5,
        autoFill: true,
        matchContains: true,
        scrollHeight: 220,
        minLength: 1, // 输入框字符个等于2时开始查询
        source: function (request, response) {
            $.ajax({
                url: 'ajax-get-shop.html', // 后台请求路径
                dataType: "json",
                data: {
                    "inputStr": request.term    // 获取输入框内容
                },
                success: function (res) {
                    if (res.data != '') {
                        response($.map(res.data, function (item) { // 此处是将返回数据转换为 JSON对象，并给每个下拉项补充对应参数
                            // console.log(item.taobao_user_nick);
                            return {
                                label: item.taobao_user_nick, // 下拉框显示值
                                value: item.taobao_user_nick, // 选中后，填充到下拉框的值
                                id: item.taobao_user_id // 其它的值
                            }
                        }));
                    }
                },
                error: function (XmlHttpRequest, textStatus, errorThrown) {
                    LAYER_MSG_FUNCTION('网络异常 请稍后再试', 2, i);
                }
            });
        },
        focus: function (event, ui) {
            $('input[name="taobao_name"]').val(ui.item.label);
            return false;
        },
        select: function (event, ui) {
            $('input[name="taobao_name"]').val(ui.item.label);
            $('input[name="taobao_id"]').val(ui.item.id);
            return false;
        },
        search: function () {
            $('input[name="taobao_id"]').val('');
        },
        messages: {
            noResults: '',
            results: function () {
            }
        }
    });
</script>
