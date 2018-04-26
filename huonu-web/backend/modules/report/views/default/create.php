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

                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#set-up-parameters" data-toggle="tab" data-placement="top" title="设置参数">
                                    <!--去掉 data-toggle="tab" 就不能切换了-->
                                    <i class="create-step">1</i>
                                    <i class="fa fa-bar-chart-o fa-fw"></i>
                                    设置参数
                                </a>
                            </li>
                            <li class="">
                                <a href="#add-survey-group" data-toggle="tab" data-placement="top" title="添加测略组">
                                    <i class="create-step">2</i>
                                    <i class="fa fa-bar-chart-o fa-fw"></i>
                                    添加测略组
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">

                            <div class="tab-pane fade in active" id="set-up-parameters">
                                <?php $form = \yii\bootstrap\ActiveForm::begin(); ?>
                                <div class="form-group form-inline">
                                    <div class="control-group">
                                        <span>复盘名称</span>
                                        <input type="text" class="form-control" placeholder="复盘名称" name="">
                                    </div>

                                    <div class="control-group">
                                        <span>店铺选择</span>
                                        <input type="text" id="taobao_name" name="taobao_name" class="form-control"
                                               placeholder="店铺选择">
                                        <input type="hidden" id="taobao_id" name="taobao_id">
                                    </div>

                                    <div class="control-group">
                                        <span>时间选择</span>
                                        <input type="text" placeholder="请选择时间" class="form-control select-time"
                                               name="select-time">
                                    </div>

                                    <div class="control-group">
                                        <span>字段选择</span>
                                        <a href="javascript:;" data-reveal-id="field-select" data-animation="fade">
                                            <i class="fa fa-gear fa-fw"></i>
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
                                                                <input type="checkbox" name="field[]" value="charge"
                                                                       checked="checked">消耗
                                                            </label>
                                                        </div>

                                                        <div class="control-group">
                                                            <span>触达</span>
                                                            <label class="form-inline">
                                                                <input type="checkbox" name="field[]" value="ad_pv"
                                                                       checked="checked">展现量
                                                            </label>
                                                        </div>

                                                        <div class="control-group">
                                                            <span>兴趣</span>
                                                            <label class="form-inline">
                                                                <input type="checkbox" name="field[]" value="click"
                                                                       checked="checked">点击量
                                                                <input type="checkbox" name="field[]" value="uv"
                                                                       checked="checked">访客
                                                            </label>
                                                        </div>

                                                        <div class="control-group">
                                                            <span>意向</span>
                                                            <label class="form-inline">
                                                                <input type="checkbox" name="field[]"
                                                                       value="deep_inshop_uv">深度进店
                                                                <input type="checkbox" name="field[]"
                                                                       value="avg_access_time">访问时长
                                                                <input type="checkbox" name="field[]"
                                                                       value="avg_access_page_num">访问页面数
                                                            </label>
                                                        </div>

                                                        <div class="control-group">
                                                            <span>行动</span>
                                                            <label class="form-inline">
                                                                <input type="checkbox" name="field[]"
                                                                       value="inshop_item_col_num" checked="checked">收藏宝贝量
                                                                <input type="checkbox" name="field[]"
                                                                       value="dir_shop_col_num" checked="checked">收藏店铺量
                                                                <input type="checkbox" name="field[]" value="cart_num"
                                                                       checked="checked">添加购物车量
                                                                <input type="checkbox" name="field[]"
                                                                       value="gmv_inshop_num">拍下订单量
                                                                <input type="checkbox" name="field[]"
                                                                       value="gmv_inshop_amt">拍下订单金额<br>
                                                                <input type="checkbox" name="field[]"
                                                                       value="commodity_collection_rate">商品收藏率
                                                                <input type="checkbox" name="field[]"
                                                                       value="purchase_rate_of_goods">商品加购率
                                                                <input type="checkbox" name="field[]"
                                                                       value="commodity_collection_cost">商品收藏成本
                                                                <input type="checkbox" name="field[]"
                                                                       value="purchase_cost_of_goods">商品加购成本
                                                                <input type="checkbox" name="field[]"
                                                                       value="purchase_cost_of_goods_collection">商品收藏加购成本
                                                            </label>
                                                        </div>

                                                        <div class="control-group">
                                                            <span>成交</span>
                                                            <label class="form-inline">
                                                                <input type="checkbox" name="field[]"
                                                                       value="alipay_in_shop_num">成交订单量
                                                                <input type="checkbox" name="field[]"
                                                                       value="alipay_inshop_amt">成交订单金额
                                                                <input type="checkbox" name="field[]"
                                                                       value="average_cost_of_order">订单平均成本
                                                                <input type="checkbox" name="field[]"
                                                                       value="order_average_amount">订单平均金额
                                                            </label>
                                                        </div>

                                                        <div class="control-group">
                                                            <span>衍生指标</span>
                                                            <label class="form-inline">
                                                                <input type="checkbox" name="field[]" value="ecpm"
                                                                       checked="checked">千次展现成本
                                                                <input type="checkbox" name="field[]" value="ctr"
                                                                       checked="checked">点击率
                                                                <input type="checkbox" name="field[]" value="ecpc"
                                                                       checked="checked">点击单价
                                                                <input type="checkbox" name="field[]" value="cvr"
                                                                       checked="checked">点击转化率
                                                                <input type="checkbox" name="field[]" value="roi"
                                                                       checked="checked">投资回报率
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
                                            <input type="radio" value="click_effect" checked="checked" name="effect">点击效果
                                            <input type="radio" value="impression" name="effect">展示效果
                                        </label>
                                    </div>

                                    <div class="control-group">
                                        <span>数据周期</span>
                                        <label class="form-inline">
                                            <input type="radio" value="3" checked="checked" name="cycle">3天
                                            <input type="radio" value="7" name="cycle">7天
                                            <input type="radio" value="15" name="cycle">15天
                                        </label>
                                    </div>

                                    <input type="submit" value="下一步，添加对比组" class="btn btn-primary">
                                </div>
                                <?php \yii\bootstrap\ActiveForm::end(); ?>
                            </div>

                            <div class="tab-pane fade" id="add-survey-group">
                                <div class="form-group">

                                    <div class="control-group">
                                        <input type="button" value="添加策略组" class="btn btn-primary add-survey-group">
                                    </div>

                                    <div class="control-group text-center" style="display: none;">
                                        <span>未添加策略组</span>
                                    </div>

                                    <div class="control-group" style="overflow: hidden;">
                                        <div class="card">
                                            <div class="strategic-group">
                                                <span class="list-group-item active">
                                                    <a href="javascript:;" class="badge"><i
                                                                class="fa fa-times">删除</i></a>
                                                    <a href="javascript:;" class="badge"><i
                                                                class="fa fa-edit">编辑</i></a>
                                                    <h4 class="list-group-item-heading">
                                                        入门网站包
                                                    </h4>
                                                </span>
                                            </div>
                                            <div class="pre-scrollable">
                                                <ul class="list-group">
                                                    <li class="list-group-item">免费域名注册</li>
                                                    <li class="list-group-item">免费 Window 空间托管</li>
                                                    <li class="list-group-item">图像的数量</li>
                                                    <li class="list-group-item">24*7 支持</li>
                                                    <li class="list-group-item">每年更新成本</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <input type="submit" value="下一步，生成报表" class="btn btn-primary">
                                        <input type="submit" value="上一步" class="btn btn-primary">
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

<<<<<<< HEAD
=======
<<<<<<< HEAD
<div class="form-group add-survey-group-html" style="display: none">
    <form class="form-horizontal" role="form">
        <div class="control-group">
            <label for="firstname" class="col-sm-3 control-label">策略组名称</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="firstname" placeholder="请输入策略组名称">
            </div>
        </div>
        <div class="control-group">
            <label for="lastname" class="col-sm-3 control-label">选择定向人群</label>
            <div class="col-sm-9">
                <ul class="list-group" id="addhtml">
                    <li class="control-group"><input type="checkbox" id="select-all"><span>全选</span></li>
                </ul>
            </div>
        </div>
        <div class="control-group">
            <div class="col-sm-offset-3 col-sm-9">
                <input type="submit" value="添加" class="btn btn-primary">
            </div>
        </div>
    </form>
=======
>>>>>>> d2aad13387316b898c788b0fd411dbc37d727b83
<div class="control-group add-survey-group-html" style="display: none">
    <div class="pre-scrollable">
        <ul class="list-group" id="addhtml">
            <li class="control-group"><input type="checkbox" id="select-all"><span>全选</span></li>
        </ul>
    </div>
<<<<<<< HEAD
=======
>>>>>>> d750cd579abda29e38724ab4959d857f10a5f0cb
>>>>>>> d2aad13387316b898c788b0fd411dbc37d727b83
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

    $('#taobao_name').autocomplete({
        minChars: 0,
        max: 5,
        autoFill: true,
        matchContains: true,
        scrollHeight: 220,
        minLength: 1,  // 输入框字符个等于2时开始查询
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
                                label: item.taobao_user_nick,   // 下拉框显示值
                                value: item.taobao_user_nick,   // 选中后，填充到下拉框的值
                                id: item.taobao_user_id // 其它的值
                            }
                        }));
                    }
                },
                error: function (XmlHttpRequest, textStatus, errorThrown) {
                    layer.msg('网络异常 请稍后再试',
                        {
                            icon: 5,
                            shade: [0.8, '#f5f5f5'],
                            time: 1000
                        }
                    );
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

    $('.add-survey-group').click(function () {
        var htmls="";
        $.ajax({
            url: 'ajax-get-target.html',
            type: 'post',
            dataType: 'json',
            success: function (res) {
                console.log(res)
<<<<<<< HEAD
                for(var i=0;i<res.data.length;i++){
                    htmls+='<li class="control-group"><input class="check-box" type="checkbox" value="'+res.data[i].taobao_user_id+'"><span>'+res.data[i].taobao_user_nick+'</span></li>'
=======
<<<<<<< HEAD
                for (var i = 0; i < res.data.length; i++) {
                    htmls += '<li class="control-group"><input class="check-box" type="checkbox" value="' + res.data[i].taobao_user_id + '"><span>' + res.data[i].taobao_user_nick + '</span></li>'
=======
                for(var i=0;i<res.data.length;i++){
                    htmls+='<li class="control-group"><input class="check-box" type="checkbox" value="'+res.data[i].taobao_user_id+'"><span>'+res.data[i].taobao_user_nick+'</span></li>'
>>>>>>> d750cd579abda29e38724ab4959d857f10a5f0cb
>>>>>>> d2aad13387316b898c788b0fd411dbc37d727b83
                }
                $('#addhtml').append(htmls)
                layer.open({
                    type: 1,
                    title: '添加策略组',
                    shadeClose: true,
                    shade: [0.5],
                    maxmin: false, //开启最大化最小化按钮
                    area: ['462px', '430px'],
                    content: $('.add-survey-group-html').html()
                });
            },
            error: function () {
                layer.msg('网络异常 请稍后再试',
                    {
                        icon: 5,
                        shade: [0.8, '#f5f5f5'],
                        time: 1000
                    }
                );
            }
        });

    });
    $(document).on('click','#select-all',function(){
        var checkbox = $(".check-box");
        if($(this).is(':checked')){
            checkbox.prop("checked", true);
        }else{
            checkbox.prop("checked", false);
        }
        
    })
<<<<<<< HEAD
=======

    // 失败的愿意是英文我这里是动态加载的
    // $('#select-all').click(function () {
    //     //全选按钮选中状态，索引0取document对象
    //     var selectAll = $(this)[0].checked;
    //     console.log(selectAll);
    //     //操作所有复选框的选中状态
    //     var checkbox = $(".check-box");
    //     console.log(checkbox);
    //     checkbox.prop("checked", selectAll);
    // })
    $(document).on('click', '#select-all', function () {
        var checkbox = $(".check-box");
        if ($(this).is(':checked')) {
            checkbox.prop("checked", true);
        } else {
            checkbox.prop("checked", false);
        }
>>>>>>> d2aad13387316b898c788b0fd411dbc37d727b83

    })

</script>