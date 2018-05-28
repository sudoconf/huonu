<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '客户计划 - 新建计划';

?>

<?= Html::cssFile('@web/css/period.css') ?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-title">
                客户计划
                <small>新建计划</small>
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
                <a href="#">新建计划</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel">

                <div class="view">
                    <div class="tabbable">

                        <ul class="nav nav-tabs" id="myTab">
                            <!--                            <li class="active">-->
                            <!--                                <a href="#select-promotion-scene" data-toggle="tab" data-placement="top" title="选择推广场景">-->
                            <!--                                    <!--去掉 data-toggle="tab" 就不能切换了-->
                            <!--                                    <i class="create-step">1</i>-->
                            <!--                                    <i class="fa fa-bar-chart-o fa-fw"></i>-->
                            <!--                                    选择推广场景-->
                            <!--                                </a>-->
                            <!--                            </li>-->

                            <li class="disabled">
                                <a href="#set-plan" data-toggle="tab" data-placement="top" title="设置计划">
                                    <i class="create-step">1</i>
                                    <i class="glyphicon glyphicon-list-alt"></i>
                                    设置计划
                                </a>
                            </li>

                            <li class="active">
                                <a href="#set-unit" data-toggle="tab" data-placement="top" title="设置单元">
                                    <i class="create-step">2</i>
                                    <i class="glyphicon glyphicon-list"></i>
                                    设置单元
                                </a>
                            </li>

                            <li class="disabled">
                                <a href="#add-creative" data-toggle="tab" data-placement="top" title="添加创意">
                                    <i class="create-step">3</i>
                                    <i class="fa fa-bar-chart-o fa-fw"></i>
                                    添加创意
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">

                            <!--选择推广场景 start-->
                            <?php //echo $this->render('select-promotion-scene.php'); ?>
                            <!--选择推广场景 end-->

                            <!--设置计划 start-->
                            <?= $this->render('set-plan.php', ['setPlan' => $setPlan]); ?>
                            <!--设置计划 end-->

                            <!--设置单元 start-->
                            <?= $this->render('set-unit.php', ['setUnit' => $setUnit]); ?>
                            <!--设置单元 end-->

                            <!--添加创意 start-->
                            <?= $this->render('add-creative.php'); ?>
                            <!--添加创意 end-->

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>


<!-- 引入jQuery的js文件 -->
<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>

<link rel="stylesheet" href="http://apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
<!-- 引入jQuery UI的js文件 -->
<?= Html::jsFile('@web/vendor/jquery-ui/jquery-ui.js') ?>

<?= Html::cssFile('@web/vendor/daterangepicker/daterangepicker.css') ?>
<?= Html::jsFile('@web/vendor/daterangepicker/moment.js') ?>
<?= Html::jsFile('@web/vendor/daterangepicker/daterangepicker.js') ?>
<?= Html::jsFile('@web/vendor/layer/layer.js') ?>
<?= Html::jsFile('@web/js/plan/plan.js') ?>
<?= Html::jsFile('@web/js/plan/unit.js') ?>
<?= Html::jsFile('@web/js/plan/creative.js') ?>

<script>
    // 店铺名称
    $('.taobao-shop-name').autocomplete({
        minChars: 0,
        max: 5,
        autoFill: true,
        matchContains: true,
        scrollHeight: 220,
        minLength: 1, // 输入框字符个等于2时开始查询
        source: function (request, response) {
            var ajaxGetShopUrl = $('.ajax-get-shop').val();
            $.ajax({
                url: ajaxGetShopUrl, // 后台请求路径
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
            $('.taobao-shop-name').val(ui.item.label);
            return false;
        },
        select: function (event, ui) {
            $('.taobao-shop-name').val(ui.item.label);
            $('#taobao-shop-name').val(ui.item.label);
            $('.taobao-shop-id').val(ui.item.id);

            // 获取地域模板
            var ajaxGetUserAreaTemplates = $('.ajax-get-user-area-templates').val();
            var taobaoShopId = $('.taobao-shop-id').val();
            $.ajax({
                url: ajaxGetUserAreaTemplates,
                dataType: "json",
                data: {
                    "taobaoShopId": taobaoShopId
                },
                success: function (res) {
                    if (res.data != '') {
                        // 获取店铺地域模板
                        var selectOptionStr = '';
                        $.each(res.data.userAreaTemplates, function (i, v) {
                            selectOptionStr += '<option value="'+ v.area_template_id+'">'+v.area_template_name+'</option>';
                        });

                        $(".area-template-id option").remove();
                        $(".area-template-id").append(selectOptionStr);
                    }
                },
                error: function (XmlHttpRequest, textStatus, errorThrown) {
                    console.log('获取店铺地域模板网络异常 请稍后再试')
                }
            });

            var ajaxGetUserTimeTemplates = $('.ajax-get-user-time-templates').val();
            // 获取时间模板
            $.ajax({
                url: ajaxGetUserTimeTemplates,
                dataType: "json",
                data: {
                    "taobaoShopId": taobaoShopId
                },
                success: function (res) {
                    if (res.data != '') {
                        // 获取店铺地域模板
                        var selectOptionStr = '';
                        $.each(res.data.userTimeTemplates, function (i, v) {
                            selectOptionStr += '<option value="'+ v.time_template_id+'">'+v.time_template_name+'</option>';
                        });

                        $(".time-template option").remove();
                        $(".time-template").append(selectOptionStr);
                    }
                },
                error: function (XmlHttpRequest, textStatus, errorThrown) {
                    console.log('获取店铺地域模板网络异常 请稍后再试')
                }
            });

            return false;
        },
        search: function () {
            $('.taobao-shop-id').val('');
        },
        messages: {
            noResults: '',
            results: function () {
            }
        }
    });


    // 时间段选择
    var cb = function (start, end, label) {
        //赋值给隐藏输入框
        $('.campaign-start-time').val(start.format('YYYY-MM-DD'));
        $('.campaign-end-time').val(end.format('YYYY-MM-DD'));
    };
    var optionSet = {
        'minDate': moment(), // 设置最小可用日期
        'startDate': moment().startOf('day'), // 默认开始时间
        'endDate': moment().add(15, 'd').endOf('day'), // 默认结束时间
        'drops': 'up',
        'ranges': {
            '15天后结束': [moment().startOf('day'), moment().add(15, 'd').endOf('day')],
            '30天后结束': [moment().startOf('day'), moment().add(30, 'd').endOf('day')],
            '60天后结束': [moment().startOf('day'), moment().add(60, 'day').endOf('day')],
            '90天后结束': [moment().startOf('day'), moment().add(90, 'day').endOf('day')],
            '自然月月底结束': [moment().startOf('day'), moment().endOf('month')],
            '次月月底结束': [moment().startOf('day'), moment().add(1, 'M').endOf('month')]
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
</script>
