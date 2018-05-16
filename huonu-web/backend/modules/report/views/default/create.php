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

                            <div class="tab-pane fade in active" id="set-up-parameters">
                                <?php
                                $form = \yii\bootstrap\ActiveForm::begin(
                                    [
                                        'id' => 'form-set-parame',
                                        'method' => 'post',
                                        'action' => 'ajax-save-set-parameter.html',
                                    ]
                                );
                                ?>
                                <div class="form-group form-inline">
                                    <div class="control-group">
                                        <span>复盘名称</span>
                                        <input type="text" class="form-control multitray-name" placeholder="复盘名称"
                                               name="multitray_name" value="<?= $setParameter['multitray_name'] ?>">
                                    </div>

                                    <div class="control-group">
                                        <span>店铺选择</span>
                                        <input type="text" id="taobao_name" value="<?= $setParameter['taobao_name'] ?>"
                                               name="taobao_name" class="form-control"
                                               placeholder="店铺选择">
                                        <input type="hidden" id="taobao_id" name="taobao_id"
                                               value="<?= $setParameter['taobao_id'] ?>">
                                    </div>

                                    <div class="control-group">
                                        <span>时间选择</span>
                                        <input type="text" placeholder="请选择时间" class="form-control select-time"
                                               name="multitray_time">
                                        <input type="hidden" name="multitray_start_time" id="multitray-start-time"
                                               value="<?= $setParameter['multitray_start_time'] ?>"/>
                                        <input type="hidden" name="multitray_end_time" id="multitray-end-time"
                                               value="<?= $setParameter['multitray_end_time'] ?>"/>
                                    </div>

                                    <div class="control-group">
                                        <span>字段选择</span>
                                        <a href="javascript:;" data-reveal-id="field-select" data-animation="fade">
                                            <i class="fa fa-gear"></i>
                                        </a>
                                        <!-- 字段选择 -->
                                        <div id="field-select" class="reveal-modal">
                                            <div class="field-box-title">

                                                <div class="field-box-title-head">
                                                    选择数据字段
                                                </div>

                                                <div class="field-box-title-center">
                                                    <div class="form-group form-inline">

                                                        <div class="control-group">
                                                            <span>消耗</span>
                                                            <label class="form-inline">
                                                                <input type="checkbox" name="multitray_field[]"
                                                                       value="charge"
                                                                    <?= in_array('charge', $setParameter['multitray_field']) ? 'checked' : '' ?>>消耗
                                                            </label>
                                                        </div>

                                                        <div class="control-group">
                                                            <span>触达</span>
                                                            <label class="form-inline">
                                                                <input type="checkbox" name="multitray_field[]"
                                                                       value="ad_pv"
                                                                    <?= in_array('ad_pv', $setParameter['multitray_field']) ? 'checked' : '' ?>>展现量
                                                            </label>
                                                        </div>

                                                        <div class="control-group">
                                                            <span>兴趣</span>
                                                            <label class="form-inline">
                                                                <input type="checkbox" name="multitray_field[]"
                                                                       value="click"
                                                                    <?= in_array('click', $setParameter['multitray_field']) ? 'checked' : '' ?>>点击量
                                                                <input type="checkbox" name="multitray_field[]"
                                                                       value="uv"
                                                                    <?= in_array('uv', $setParameter['multitray_field']) ? 'checked' : '' ?>>访客
                                                            </label>
                                                        </div>

                                                        <div class="control-group">
                                                            <span>意向</span>
                                                            <label class="form-inline">
                                                                <input type="checkbox" name="multitray_field[]"
                                                                       value="deep_inshop_uv" disabled>深度进店
                                                                <input type="checkbox" name="multitray_field[]"
                                                                       value="avg_access_time" disabled>访问时长
                                                                <input type="checkbox" name="multitray_field[]"
                                                                       value="avg_access_page_num" disabled>访问页面数
                                                            </label>
                                                        </div>

                                                        <div class="control-group">
                                                            <span>行动</span>
                                                            <label class="form-inline">
                                                                <input type="checkbox" name="multitray_field[]"
                                                                       value="inshop_item_col_num" <?= in_array('inshop_item_col_num', $setParameter['multitray_field']) ? 'checked' : '' ?>>收藏宝贝量
                                                                <input type="checkbox" name="multitray_field[]"
                                                                       value="dir_shop_col_num" <?= in_array('dir_shop_col_num', $setParameter['multitray_field']) ? 'checked' : '' ?>>收藏店铺量
                                                                <input type="checkbox" name="multitray_field[]"
                                                                       value="cart_num" <?= in_array('cart_num', $setParameter['multitray_field']) ? 'checked' : '' ?>>添加购物车量
                                                                <input type="checkbox" name="multitray_field[]"
                                                                       value="gmv_inshop_num" disabled>拍下订单量
                                                                <input type="checkbox" name="multitray_field[]"
                                                                       value="gmv_inshop_amt" disabled>拍下订单金额<br>
                                                                <input type="checkbox" name="multitray_field[]"
                                                                       value="commodity_collection_rate" disabled>商品收藏率
                                                                <input type="checkbox" name="multitray_field[]"
                                                                       value="purchase_rate_of_goods" disabled>商品加购率
                                                                <input type="checkbox" name="multitray_field[]"
                                                                       value="commodity_collection_cost" disabled>商品收藏成本
                                                                <input type="checkbox" name="multitray_field[]"
                                                                       value="purchase_cost_of_goods" disabled>商品加购成本
                                                                <input type="checkbox" name="multitray_field[]"
                                                                       value="purchase_cost_of_goods_collection"
                                                                       disabled>商品收藏加购成本
                                                            </label>
                                                        </div>

                                                        <div class="control-group">
                                                            <span>成交</span>
                                                            <label class="form-inline">
                                                                <input type="checkbox" name="multitray_field[]"
                                                                       value="alipay_in_shop_num" disabled>成交订单量
                                                                <input type="checkbox" name="multitray_field[]"
                                                                       value="alipay_inshop_amt" disabled>成交订单金额
                                                                <input type="checkbox" name="multitray_field[]"
                                                                       value="average_cost_of_order" disabled>订单平均成本
                                                                <input type="checkbox" name="multitray_field[]"
                                                                       value="order_average_amount" disabled>订单平均金额
                                                            </label>
                                                        </div>

                                                        <div class="control-group">
                                                            <span>衍生指标</span>
                                                            <label class="form-inline">
                                                                <input type="checkbox" name="multitray_field[]"
                                                                       value="ecpm" <?= in_array('ecpm', $setParameter['multitray_field']) ? 'checked' : '' ?>>千次展现成本
                                                                <input type="checkbox" name="multitray_field[]"
                                                                       value="ctr" <?= in_array('ctr', $setParameter['multitray_field']) ? 'checked' : '' ?>>点击率
                                                                <input type="checkbox" name="multitray_field[]"
                                                                       value="ecpc" <?= in_array('ecpc', $setParameter['multitray_field']) ? 'checked' : '' ?>>点击单价
                                                                <input type="checkbox" name="multitray_field[]"
                                                                       value="cvr" <?= in_array('cvr', $setParameter['multitray_field']) ? 'checked' : '' ?>>点击转化率
                                                                <input type="checkbox" name="multitray_field[]"
                                                                       value="roi" <?= in_array('roi', $setParameter['multitray_field']) ? 'checked' : '' ?>>投资回报率
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
                                                    <div class="control-group">
                                                        <span>可拖动排序</span>
                                                        <input type="button" value="清空"
                                                               class="btn btn-primary pull-right">
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
                                                            <li class="list-group-item">千次展现成本</li>
                                                            <li class="list-group-item">点击率</li>
                                                            <li class="list-group-item">点击单价</li>
                                                            <li class="list-group-item">点击转化率</li>
                                                            <li class="list-group-item">投资回报率</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <a class="close-reveal-modal">&#215;</a>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <span>效果模型</span>
                                        <label class="form-inline">
                                            <input type="radio" value="click"
                                                <?= $setParameter['multitray_effect_model'] == 'click' ? 'checked' : '' ?>
                                                   name="multitray_effect_model">点击效果
                                            <input type="radio" value="impression" name="multitray_effect_model"
                                                <?= $setParameter['multitray_effect_model'] == 'impression' ? 'checked' : '' ?>>展示效果
                                        </label>
                                    </div>

                                    <div class="control-group">
                                        <span>数据周期</span>
                                        <label class="form-inline">
                                            <input type="radio" value="3"
                                                <?= ($setParameter['multitray_cycle'] == 3) ? 'checked' : '' ?>
                                                   name="multitray_cycle">3天
                                            <input type="radio" value="7"
                                                <?= ($setParameter['multitray_cycle'] == 7) ? 'checked' : '' ?>
                                                   name="multitray_cycle">7天
                                            <input type="radio" value="15"
                                                <?= ($setParameter['multitray_cycle'] == 15) ? 'checked' : '' ?>
                                                   name="multitray_cycle">15天
                                        </label>
                                    </div>


                                    <span class="create btn btn-primary">下一步，添加对比组</span>
                                </div>
                                <?php \yii\bootstrap\ActiveForm::end(); ?>
                            </div>

                            <div class="tab-pane fade" id="add-survey-group">
                                <?php
                                $form = \yii\bootstrap\ActiveForm::begin(
                                    [
                                        'id' => 'add-survey-group',
                                        'method' => 'post',
                                        'action' => 'ajax-save-strategy-group.html',
                                    ]
                                );
                                ?>
                                <div class="form-group">

                                    <div class="control-group">
                                        <input type="button" value="添加策略组" class="btn btn-primary add-survey-group">
                                    </div>

                                    <div class="control-group survey-group" style="overflow: hidden;">
                                        <?php
                                        if (empty($strategyGroup)) { ?>
                                            <div class="not-added-policy-group text-center pt40 pb60">
                                                <div class="s_fs_16 pd15">未添加策略组</div>
                                            </div>
                                        <?php } else {
                                            foreach ($strategyGroup as $k => $v) { ?>
                                                <div class="card">
                                                    <div class="strategic-group">
                                                    <span class="list-group-item active">
                                                        <a href="javascript:;" class="badge del-strategic-group">
                                                            <i class="fa fa-times">删除</i>
                                                        </a>
                                                        <a href="javascript:;" class="badge edit-strategic-group">
                                                            <i class="fa fa-edit">编辑</i>
                                                        </a>
                                                        <h4 class="list-group-item-heading"><?= $k ?></h4>
                                                    </span>
                                                    </div>
                                                    <div class="pre-scrollable">
                                                        <ul class="list-group">
                                                            <?php foreach ($v as $tk => $tv) { ?>
                                                                <li class="list-group-item">
                                                                    <?= $tv['targetName'] ?>
                                                                </li>
                                                            <?php } ?>
                                                        </ul>
                                                    </div>
                                                </div>

                                            <?php }
                                        } ?>

                                    </div>

                                    <div class="control-group">
                                        <input type="button" value="下一步，生成报表" class="btn btn-primary generate-report">
                                        <input type="button" value="上一步" class="btn btn-primary last-step">
                                    </div>

                                </div>
                                <?php \yii\bootstrap\ActiveForm::end() ?>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

<!--弹窗添加策略组-->
<div class="form-group add-survey-group-html" style="display: none">
    <form class="form-horizontal" role="form">
        <div class="control-group">
            <label for="target-name" class="col-sm-3 control-label">策略组名称</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="target-name" id="target-name" placeholder="请输入策略组名称">
            </div>
        </div>
        <div class="control-group">
            <label for="lastname" class="col-sm-3 control-label">选择定向人群</label>
            <div class="col-sm-9">
                <ul class="list-group pre-scrollable" id="addhtml">
                    <li class="control-group"><input type="checkbox" id="select-all"><span>全选</span></li>
                </ul>
            </div>
        </div>
        <div class="control-group">
            <label class="col-sm-3 control-label"></label>
            <span class="btn btn-primary add-survey-group-operate">添加</span>
        </div>
    </form>
</div>

<!-- 引入jQuery的js文件 -->
<!--<script src="http://apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>-->
<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="http://apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
<!-- 引入jQuery UI的js文件 -->
<?= Html::jsFile('@web/vendor/jquery-ui/jquery-ui.js') ?>

<?= Html::jsFile('@web/vendor/daterangepicker/moment.js') ?>
<?= Html::jsFile('@web/vendor/daterangepicker/daterangepicker.js') ?>


<!-- 弹出层 reveal.js -->
<?= Html::jsFile('@web/vendor/jquery-reveal/jquery.reveal.js') ?>
<!-- 拖动 jquery-sortable.js -->
<?= Html::jsFile('@web/vendor/jquery-sortable/jquery-sortable.js') ?>

<script>
    $("[data-toggle='tab']").tooltip(); // 工具提示（Tooltip）插件 - 锚

    // 时间段选择
    var cb = function (start, end, label) {
        //赋值给隐藏输入框
        $('#multitray-start-time').val(start.format('YYYY-MM-DD'));
        $('#multitray-end-time').val(end.format('YYYY-MM-DD'));
    };
    var optionSet = {
        'timePicker': true, //显示时间
        'timePicker24Hour': true, //时间制
        'timePickerSeconds': true, //时间显示到秒
        'showDropdowns': true,
        'showWeekNumbers': true,
        'startDate': moment(),
        'endDate': moment().endOf('day'),
        'opens': 'right',
        'drops': 'down',
        'format': 'YYYY-MM-DD',
        'autoUpdateInput': true, // 当前默认时间
        'ranges': {
            // '最近1小时': [moment().subtract('hours',1), moment()],
            '今天': [moment().startOf('day'), moment()],
            '昨天': [moment().subtract(1, 'days').startOf('day'), moment().subtract(1, 'days').endOf('day')],
            '7天': [moment().subtract(7, 'days').startOf('day'), moment().endOf('day')],
            '15天': [moment().subtract(15, 'days').startOf('day'), moment().endOf('day')],
            '30天': [moment().subtract(30, 'days').startOf('day'), moment().endOf('day')],
            '这个月': [moment().startOf('month').startOf('day'), moment().endOf('month').endOf('day')],
            '上个月': [moment().subtract(1, 'month').startOf('month').startOf('day'), moment().subtract(1, 'month').endOf('month').endOf('day')],
            // '近俩个月': [moment().subtract(2, 'month').startOf('month').startOf('day'), moment().subtract(1, 'month').endOf('month').endOf('day')],
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

    // 拖动排序
    $('ul.custom-fields').sortable();

    // jquery ajax autocomplete 自动完成
    $('#taobao_name').autocomplete({
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
            $('#taobao_name').val(ui.item.label);
            return false;
        },
        select: function (event, ui) {
            $('#taobao_name').val(ui.item.label);
            $('#taobao_id').val(ui.item.id);
            return false;
        },
        search: function () {
            $('#taobao_id').val('');
        },
        messages: {
            noResults: '',
            results: function () {
            }
        }
    });

    // 第一步骤 提交数据
    $(document).on('click', '.create', function () {

        if ($('.multitray-name').val() == '') {
            LAYER_MSG('请正确填写复盘名称');
            return false;
        }

        if ($('#taobao_id').val() == '') {
            LAYER_MSG('请正确选择店铺');
            return false;
        }

        if ($('#multitray-start-time').val() == '') {
            LAYER_MSG('请正确选择时间');
            return false;
        }

        if ($("input[name='multitray_field[]']:checked").length == 0) {
            LAYER_MSG('请正确选择字段');
            return false;
        }

        var form = $('form#form-set-parame');
        // console.log(form.serialize());

        //表单提交
        $.ajax({
            url: form.attr('action'),
            type: 'post',
            data: form.serialize(),
            beforeSend: function () {
                i = SHOW_LOAD_LAYER();
            },
            success: function (response) {

                if (response.result == true) {
                    LAYER_MSG_FUNCTION('提交成功', 1, i);
                    $('.nav-tabs li').eq(0).removeClass('active').siblings('li').addClass('active');
                    $('.nav-tabs li').eq(0).addClass('disabled');

                    $('.tab-pane').eq(0).removeClass('active in');
                    $('.tab-pane').eq(1).addClass('active in');

                    // 页面加载的时候获取定向人群
                    var taobaoId = $('#taobao_id').val();
                    var htmlStr = '';
                    $.ajax({
                        url: 'ajax-get-target.html',
                        type: 'get',
                        data: {'taobao_id': taobaoId},
                        dataType: 'json',
                        success: function (res) {
//                console.log(res);
                            for (var i = 0; i < res.data.length; i++) {
                                htmlStr += '<li class="control-group"><input class="check-box" type="checkbox" value="' + res.data[i].target_id + '" title="' + res.data[i].target_name + '"><span>' + res.data[i].target_name + '</span></li>';
                            }
                            $('#addhtml').append(htmlStr)
                        },
                        error: function () {
                            console.log('网络异常 请稍后再试');
                        }
                    });

                } else {
                    LAYER_MSG_FUNCTION(response.message, 2, i);
                }

            },
            error: function (e, jqxhr, settings, exception) {
                LAYER_MSG_FUNCTION('加载失败', 2, i);
            }
        });
    });

    // 第二步骤
    $('.add-survey-group').click(function () {
        layer.open({
            type: 1,
            title: '添加策略组',
            shadeClose: true,
            shade: [0.5],
            maxmin: false, //开启最大化最小化按钮
            area: ['580px', '500px'],
            content: $('.add-survey-group-html') // TODO 这里如果写成 $('.add-survey-group-html').html 就会获取不到 弹窗的 input value 值
        });
    });

    // 失败的愿意是因为我这里是动态加载的
    // $('#select-all').click(function () {
    //     //全选按钮选中状态，索引0取document对象
    //     var selectAll = $(this)[0].checked;
    //     //操作所有复选框的选中状态
    //     var checkbox = $(".check-box");
    //     console.log(checkbox);
    //     checkbox.prop("checked", selectAll);
    // })

    // 全选、反选
    $(document).on('click', '#select-all', function () {
        var checkbox = $(".check-box");
        if ($(this).is(':checked')) {
            checkbox.prop("checked", true);
        } else {
            checkbox.prop("checked", false);
        }
    });

    // TODO 添加 策略组显示页面
    $(document).on('click', '.add-survey-group-operate', function () {

        var targetName = $("#target-name").val();
        if (targetName == '') {
            LAYER_MSG('请正确填写策略组名称');
            return false;
        }

        if ($("input.check-box:checked").length == 0) {
            LAYER_MSG('请正确选择定向人群');
            return false;
        }

        // 策略组最多只能添加 9 个  这里只能通过 session 来判断
        var surveyGroupLength = $('.survey-group .card').length;
        if (surveyGroupLength > 8) {
            LAYER_MSG('策略组只能添加9个');
            return false;
        }

        var htmlStr = '<div class="card">';
        htmlStr += '<div class="strategic-group"><span class="list-group-item active">';
        htmlStr += '<a href="javascript:;" class="badge del-strategic-group"><i class="fa fa-times">删除</i></a>';
        htmlStr += '<a href="javascript:;" class="badge edit-strategic-group"><i class="fa fa-edit">编辑</i></a>';
        htmlStr += '<h4 class="list-group-item-heading">' + targetName + '</h4></span></div><div class="pre-scrollable"><ul class="list-group">';

        var dataJson = '{"' + targetName + '": [';
        $('.check-box').each(function (index, element) {
            if ($(this).is(':checked')) {
                htmlStr += '<li class="list-group-item">' + $(this).attr('title') + '</li>';
                dataJson += '{"targetId": "' + $(this).val() + '","targetName": "' + $(this).attr('title') + '"},'
            }
        });

        dataJson = dataJson.substring(0, dataJson.length - 1);
        dataJson += ']}';

        // 合并 数组
        htmlStr += '</ul></div></div>';

        // ajax 提交策略组信息
        $.ajax({
            url: 'ajax-save-strategy-group.html',
            type: 'post',
            data: JSON.parse(dataJson), // 字符串转 json 对象
            dataType: 'json',
            beforeSend: function () {
                i = SHOW_LOAD_LAYER();
            },
            success: function (response) {
                CLOSE_LOAD_LAYER(i);

                if (response.result == "true") {
                    // 隐藏未添加策略组
                    $('.not-added-policy-group').css('display', 'none');

                    $('.survey-group').append(htmlStr);
                    layer.closeAll();
                } else {
                    LAYER_MSG_FUNCTION('加载失败', 2, i);
                }

            },
            error: function (e, jqxhr, settings, exception) {
                LAYER_MSG_FUNCTION('加载失败', 2, i);
            }
        });
        return false;
    });

    // TODO 删除策略组
    $(document).on('click', '.del-strategic-group', function () {

        var targetName = $(this).parent().find('h4').html(); // 查找当前点击的父元素的 h4 标签 html

        var parentDom = $(this).parents('.card'); // parent 和 parents(找到某一特定的祖先元素): 只能找上一级别
        parentDom.remove();

        var cardLength = $('.survey-group').children('.card').length; // 获取 div 的个数
        if (cardLength <= 0) {
            var html = '<div class="not-added-policy-group text-center pt40 pb60"><div class="s_fs_16 pd15">未添加策略组</div></div>';
            $('.survey-group').append(html);
        }

        $.ajax({
            url: 'ajax-del-strategy-group.html',
            type: 'post',
            data: {'targetName': targetName}, // 字符串转 json 对象
            dataType: 'json',
            beforeSend: function () {
                i = SHOW_LOAD_LAYER();
            },
            success: function (response) {
                CLOSE_LOAD_LAYER(i);

                if (response.result != "true") {
                    LAYER_MSG_FUNCTION('加载失败', 2, i);
                }

            },
            error: function (e, jqxhr, settings, exception) {
                LAYER_MSG_FUNCTION('加载失败', 2, i);
            }
        });

    });

    // TODO 编辑策略组
    $('.edit-strategic-group').click(function () {
    });

    // TODO 生成报表
    $('.generate-report').click(function () {

        // ajax 提交策略组信息
        $.ajax({
            url: 'ajax-generate-statistic.html',
            type: 'post',
            dataType: 'json',
            beforeSend: function () {
                i = SHOW_LOAD_LAYER();
            },
            success: function (response) {

                if (response.result == true) {

                    LAYER_MSG_FUNCTION('报表生成成功', 1, i);

                    // 报表生成成功 跳转页面
                    window.location.href = 'index.html';
                } else {
                    LAYER_MSG_FUNCTION('加载失败', 2, i);
                }

            },
            error: function (e, jqxhr, settings, exception) {
                LAYER_MSG_FUNCTION('加载失败', 2, i);
            }
        });
        return false;

    });

    // TODO 上一步
    $('.last-step').on('click', function () {
        $('.nav-tabs li').eq(1).removeClass('active').siblings('li').addClass('disabled');
        $('.nav-tabs li').eq(0).addClass('active');
        $('.tab-pane').eq(1).removeClass('active in');
        $('.tab-pane').eq(0).addClass('active in');
    });

</script>