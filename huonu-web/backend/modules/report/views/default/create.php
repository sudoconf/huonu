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
                           name="multitray_name">
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
                           name="multitray_time">
                    <input type="hidden" name="multitray_start_time" id="multitray-start-time"/>
                    <input type="hidden" name="multitray_end_time" id="multitray-end-time"/>
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
                                       checked="checked">消耗
                              </label>
                            </div>

                            <div class="control-group">
                              <span>触达</span>
                              <label class="form-inline">
                                <input type="checkbox" name="multitray_field[]"
                                       value="ad_pv"
                                       checked="checked">展现量
                              </label>
                            </div>

                            <div class="control-group">
                              <span>兴趣</span>
                              <label class="form-inline">
                                <input type="checkbox" name="multitray_field[]"
                                       value="click"
                                       checked="checked">点击量
                                <input type="checkbox" name="multitray_field[]"
                                       value="uv"
                                       checked="checked">访客
                              </label>
                            </div>

                            <div class="control-group">
                              <span>意向</span>
                              <label class="form-inline">
                                <input type="checkbox" name="multitray_field[]"
                                       value="deep_inshop_uv">深度进店
                                <input type="checkbox" name="multitray_field[]"
                                       value="avg_access_time">访问时长
                                <input type="checkbox" name="multitray_field[]"
                                       value="avg_access_page_num">访问页面数
                              </label>
                            </div>

                            <div class="control-group">
                              <span>行动</span>
                              <label class="form-inline">
                                <input type="checkbox" name="multitray_field[]"
                                       value="inshop_item_col_num" checked="checked">收藏宝贝量
                                <input type="checkbox" name="multitray_field[]"
                                       value="dir_shop_col_num" checked="checked">收藏店铺量
                                <input type="checkbox" name="multitray_field[]"
                                       value="cart_num"
                                       checked="checked">添加购物车量
                                <input type="checkbox" name="multitray_field[]"
                                       value="gmv_inshop_num">拍下订单量
                                <input type="checkbox" name="multitray_field[]"
                                       value="gmv_inshop_amt">拍下订单金额<br>
                                <input type="checkbox" name="multitray_field[]"
                                       value="commodity_collection_rate">商品收藏率
                                <input type="checkbox" name="multitray_field[]"
                                       value="purchase_rate_of_goods">商品加购率
                                <input type="checkbox" name="multitray_field[]"
                                       value="commodity_collection_cost">商品收藏成本
                                <input type="checkbox" name="multitray_field[]"
                                       value="purchase_cost_of_goods">商品加购成本
                                <input type="checkbox" name="multitray_field[]"
                                       value="purchase_cost_of_goods_collection">商品收藏加购成本
                              </label>
                            </div>

                            <div class="control-group">
                              <span>成交</span>
                              <label class="form-inline">
                                <input type="checkbox" name="multitray_field[]"
                                       value="alipay_in_shop_num">成交订单量
                                <input type="checkbox" name="multitray_field[]"
                                       value="alipay_inshop_amt">成交订单金额
                                <input type="checkbox" name="multitray_field[]"
                                       value="average_cost_of_order">订单平均成本
                                <input type="checkbox" name="multitray_field[]"
                                       value="order_average_amount">订单平均金额
                              </label>
                            </div>

                            <div class="control-group">
                              <span>衍生指标</span>
                              <label class="form-inline">
                                <input type="checkbox" name="multitray_field[]"
                                       value="ecpm"
                                       checked="checked">千次展现成本
                                <input type="checkbox" name="multitray_field[]"
                                       value="ctr"
                                       checked="checked">点击率
                                <input type="checkbox" name="multitray_field[]"
                                       value="ecpc"
                                       checked="checked">点击单价
                                <input type="checkbox" name="multitray_field[]"
                                       value="cvr"
                                       checked="checked">点击转化率
                                <input type="checkbox" name="multitray_field[]"
                                       value="roi"
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
                      <input type="radio" value="click" checked="checked" name="multitray_effect_model">点击效果
                      <input type="radio" value="impression" name="multitray_effect_model">展示效果
                    </label>
                  </div>

                  <div class="control-group">
                    <span>数据周期</span>
                    <label class="form-inline">
                      <input type="radio" value="3" checked="checked" name="multitray_cycle">3天
                      <input type="radio" value="7" name="multitray_cycle">7天
                      <input type="radio" value="15" name="multitray_cycle">15天
                    </label>
                  </div>


                  <span id="oneStep" class="create btn btn-primary">下一步，添加对比组</span>
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
                    <div class="not-added-policy-group text-center pt40 pb60">
                      <div class="s_fs_16 pd15">未添加策略组</div>
                    </div>
                  </div>

                  <div class="control-group">
                    <input type="button" value="下一步，生成报表" class="btn btn-primary generate-report">
                    <input type="button" value="上一步" class="btn btn-primary" id="shangyibu">
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
        $('.select-time span').html(start.format('YYYY-MM-DD HH:mm:ss'));

        //赋值给隐藏输入框
        $('#multitray-start-time').val(start.format('YYYY-MM-DD HH:mm:ss'));
        $('#multitray-end-time').val(end.format('YYYY-MM-DD HH:mm:ss'));
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
        'format': 'YYYY-MM-DD HH:mm:ss',
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
            'format': 'YYYY-MM-DD HH:mm:ss',
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


    // 第一步骤 提交数据
    $(document).on('click', '.create', function () {

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
                CLOSE_LOAD_LAYER(i);
                console.log(response);


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
        return false;
    });

    // 页面加载的时候获取定向人群
    $(document).ready(function () {
        var htmlStr = '';
        $.ajax({
            url: 'ajax-get-target.html',
            type: 'get',
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

                // 策略组最多只能添加 9 个  这里只能通过 session 来判断
                var surveyGroupLength = $('.survey-group .card').length;
                if (surveyGroupLength > 9) {
                    layer.msg('策略组只能添加9个！', {
                        icon: 2,
                        time: 5000 //2秒关闭（如果不配置，默认是3秒）
                    }, function () {
                        CLOSE_LOAD_LAYER(i);
                    });
                    return false;
                }
            },
            success: function (response) {
                CLOSE_LOAD_LAYER(i);

                if (response.result == "true") {
                    // 隐藏未添加策略组
                    $('.not-added-policy-group').css('display', 'none');

                    $('.survey-group').append(htmlStr);
                    layer.closeAll();
                } else {
                    LAYER_MSG('加载失败！', i);
                }

            },
            error: function (e, jqxhr, settings, exception) {
                LAYER_MSG('加载失败！', i);
            }
        });
        return false;
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
                CLOSE_LOAD_LAYER(i);

                if (response.result == "true") {
                    LAYER_MSG('报表生成成功！', i);
                } else {
                    LAYER_MSG('加载失败！', i);
                }

            },
            error: function (e, jqxhr, settings, exception) {
                LAYER_MSG('加载失败！', i);
            }
        });
        return false;

    });


    //第一步
    // $('#oneStep').on('click', function () {
    //     var taobao_name = $('#taobao_name').val()//这是一个测试条件
    //     if (taobao_name == "") {
    //         layer.msg('请填写完整才能到下一步');
    //     } else {
    //         $('.nav-tabs li').eq(1).addClass('active').siblings('li').removeClass('active');
    //         $('.tab-pane').eq(0).removeClass('active in');
    //         $('.tab-pane').eq(1).addClass('active in');
    //     }
    // });

    //上一步
    // $('#shangyibu').on('click', function () {
    //     $('.nav-tabs li').eq(0).addClass('active').siblings('li').removeClass('active');
    //     $('.tab-pane').eq(1).removeClass('active in');
    //     $('.tab-pane').eq(0).addClass('active in');
    //
    // });

</script>