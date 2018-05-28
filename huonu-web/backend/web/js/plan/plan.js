// 计划 js
$(function () {

    $("[data-toggle='tab']").tooltip(); // 工具提示（Tooltip）插件 - 锚


    // 地域设置 显示隐藏
    $('.region').click(function () {

        var regionVal = $(this).val();
        if (regionVal == 1) {
            $('.area-template-id').hide();
            $('.area-template-id').removeAttr('name');

            $('.common-area').attr('name', 'area_id_list[]');
            $('.rarely-used-area').attr('name', 'area_id_list[]');

            $('.region-select').show();
        } else {
            $('.area-template-id').show();
            $('.area-template-id').attr('name', 'area-template-id');

            $('.common-area').removeAttr('name');
            $('.rarely-used-area').removeAttr('name');

            $('.region-select').hide();
        }
    });

    // 常用地区全选、反选
    $('.select-all-common-area').click(function () {
        var checkbox = $('.common-area');
        if ($(this).is(':checked')) {
            checkbox.prop("checked", true);
        } else {
            checkbox.prop("checked", false);
        }
    });

    // 不常用地区全选、反选
    $('.select-all-rarely-used-area').click(function () {
        var checkbox = $('.rarely-used-area');
        if ($(this).is(':checked')) {
            checkbox.prop("checked", true);
        } else {
            checkbox.prop("checked", false);
        }
    });

    // 地域保存 div 自定义模板最多保存10个，如果您要添加新模板，请先对老模板进行移除。
    $('.area-list-show-input').click(function () {
        $('.save-plan').css('display', 'none');
        $('.show-area-input').css('display', 'block');
    });

    // 取消地域保存
    $('.cancel-plan-operate').click(function () {
        $('.show-area-input').css('display', 'none');
        $('.save-plan').css('display', 'block');
    });

    // ajax 保存地域模板
    $('.save-area-operate').click(function () {

        var taobaoUserId = $('.taobao-shop-id').val();
        if (taobaoUserId == '') {
            LAYER_MSG('请正确选择店铺');
            return false;
        }

        // 判断模板名称
        var areaTemplateName = $('.area-template-name').val();
        if (areaTemplateName == '') {
            LAYER_MSG('请输入模板名');
            return false;
        }

        var areaIdList = new Array();
        $('input[name="area-id-list[]"]:checked').each(function () {
            areaIdList.push($(this).val()); // 向数组中添加元素
        });

        if (areaIdList.length <= 0) {
            LAYER_MSG('请至少选择一个投放地域');
            return false;
        }

        areaIdList = areaIdList.sort(function (a, b) {
            return a - b;
        });

        var areaIdListStr = areaIdList.join(',');
        // console.log(areaIdListStr);
        var url = $('.ajax_create_area_template').val();
        $.ajax({
            url: url,
            dataType: "json",
            type: 'post',
            data: {
                'area_id_list': areaIdListStr,
                'area_template_name': areaTemplateName,
                'taobao_user_id': taobaoUserId,
            },
            success: function (res) {
                if (res.result == true) {

                    $('.show-area-input').hide();
                    $('.save-success').show().delay(1000).fadeOut();
                    $('.save-plan').show();

                    // 获取店铺地域模板
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
                                    selectOptionStr += '<option value="' + v.area_template_id + '">' + v.area_template_name + '</option>';
                                });

                                $(".area-template-id option").remove();
                                $(".area-template-id").append(selectOptionStr);
                            }
                        },
                        error: function (XmlHttpRequest, textStatus, errorThrown) {
                            console.log('获取店铺地域模板网络异常 请稍后再试')
                        }
                    });

                    return false;

                } else {
                    LAYER_MSG('已存在同名模板');
                }
            },
            error: function (XmlHttpRequest, textStatus, errorThrown) {
                LAYER_MSG('网络异常 请稍后再试');
            }
        });
    });


    // 时间保存 div
    $('.period-list-show-input').click(function () {
        $('.save-period').css('display', 'none');
        $('.show-period-input').css('display', 'block');
    });

    // 取消时间保存
    $('.cancel-period-operate').click(function () {
        $('.show-period-input').css('display', 'none');
        $('.save-period').css('display', 'block');
    });

    // ajax 保存时间模板
    $('.save-period-operate').click(function () {

        var taobaoUserId = $('.taobao-shop-id').val();
        if (taobaoUserId == '') {
            LAYER_MSG('请正确选择店铺');
            return false;
        }

        // 判断模板名称
        var timeTemplateName = $('.time-template-name').val();
        if (timeTemplateName == '') {
            LAYER_MSG('请输入模板名');
            return false;
        }

        // 获取时间下拉框的val
        var workDays = $('#work-days').val();
        var weekEnds = $('#week-ends').val();

        // var array = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24'];
        // var workDaysValue = ['false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false'];
        //
        // var weekEndsValue = ['false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false'];
        //
        // for (var i = 0; i < workDays.length; i++) {
        //     var index = $.inArray(workDays[i], array);
        //     if (index >= 0) {
        //         workDaysValue.splice(index, 1, 'true');
        //     }
        // }
        //
        // for (var i = 0; i < weekEnds.length; i++) {
        //     var index = $.inArray(weekEnds[i], array);
        //     if (index >= 0) {
        //         weekEndsValue.splice(index, 1, 'true');
        //     }
        // }

        var url = $('.ajax-create-time-template').val();
        $.ajax({
            url: url,
            dataType: "json",
            type: 'post',
            data: {
                'taobao_user_id': taobaoUserId,
                'time_template_name': timeTemplateName,
                'time_template_workday': workDays.toString(),
                'time_template_weekend': weekEnds.toString()
            },
            success: function (res) {
                if (res.result == true) {

                    $('.show-period-input').hide();
                    $('.save-time-template-success').show().delay(1000).fadeOut();
                    $('.save-period').show();

                    // 获取店铺地域模板
                    var ajaxGetUserTimeTemplates = $('.ajax-get-user-time-templates').val();
                    var taobaoShopId = $('.taobao-shop-id').val();
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
                                    selectOptionStr += '<option value="' + v.time_template_id + '">' + v.time_template_name + '</option>';
                                });

                                $(".time-template option").remove();
                                $(".time-template").append(selectOptionStr);
                            }
                        },
                        error: function (XmlHttpRequest, textStatus, errorThrown) {
                            console.log('获取店铺时间模板网络异常 请稍后再试')
                        }
                    });

                    return false;

                } else {
                    LAYER_MSG('已存在同名模板');
                }
            },
            error: function (XmlHttpRequest, textStatus, errorThrown) {
                LAYER_MSG('网络异常 请稍后再试');
            }
        });
    });

    // 时段设置 显示隐藏
    $('.period-type').click(function () {

        var periodTypeVal = $(this).val();
        if (periodTypeVal == 1) {
            $('.time-template').hide();

            $('#work-days').attr('name', 'workdays[]');
            $('#week-ends').attr('name', 'week_ends[]');

            $('.period-type-select').show();
        } else {
            $('.time-template').show();

            $('#work-days').removeAttr('name');
            $('#week-ends').removeAttr('name');

            $('.period-type-select').hide();
        }
    });

    // 选中时间
    // $('.periodWrapper .period ul li').click(function () {
    // });

    // ajax 提交 计划设置
    $('.create-plan').click(function () {

        if ($('#taobao_shop_name').val() == '' || $('.taobao_user_id').val() == '') {
            LAYER_MSG('请正确选择店铺');
            return false;
        }

        var dayBudget = $('input[name=day_budget]').val();
        if (!dayBudget || dayBudget == '') {
            LAYER_MSG('请正确填写每日预算，每日预算必须大于等于 300');
            return false;
        }

        var form = $('form#form-set-plan');

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
                    $('.nav-tabs li').eq(1).removeClass('disabled');
                    $('.nav-tabs li').eq(2).removeClass('active');

                    $('.tab-pane').eq(0).removeClass('active in');
                    $('.tab-pane').eq(1).addClass('active in');

                } else {
                    LAYER_MSG_FUNCTION(response.message, 2, i);
                }

            },
            error: function (e, jqxhr, settings, exception) {
                LAYER_MSG_FUNCTION('加载失败', 2, i);
            }
        });

    });

});