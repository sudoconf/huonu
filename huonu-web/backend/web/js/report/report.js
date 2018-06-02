$(function () {

    $("[data-toggle='tab']").tooltip(); // 工具提示（Tooltip）插件 - 锚

    // 设置参数 提交数据
    $('.setParamConfirm').click(function () {
        var multitrayField, _this, multitrayFields = new Array();
        if ($('input[name="multitray_name"]').val() == '') {
            LAYER_MSG('请正确填写复盘名称');
            return false;
        }

        if ($('input[name="taobao_id"]').val() == '') {
            LAYER_MSG('请正确选择店铺');
            return false;
        }

        if ($('input[name="multitray_start_time"]').val() == '') {
            LAYER_MSG('请正确选择时间');
            return false;
        }

        multitrayField = $("input[name='multitray_field[]']:checked");
        if (multitrayField.length == 0) {
            LAYER_MSG('请正确选择字段');
            return false;
        } else {
            $(multitrayField).each(function () {
                _this = $(this);
                multitrayFields.push(_this.val());
            });
            $('input[name="multitray_field"]').val(multitrayFields);
        }

        var form = $('form#form-set-parame');
        // console.log(form.serialize());

        //表单提交
        $.ajax({
            url: form.attr('action'),
            type: 'post',
            data: form.serialize(),
            beforeSend: function () {
            },
            success: function (response) {

                if (response.result == true) {
                    LAYER_MSG_('提交成功', 1);
                    $('.nav-tabs li').eq(0).removeClass('active').siblings('li').addClass('active');
                    $('.nav-tabs li').eq(0).addClass('disabled');

                    $('.tab-pane').eq(0).removeClass('active in');
                    $('.tab-pane').eq(1).addClass('active in');
                } else {
                    LAYER_MSG_('服务器错误', 2);
                }

            },
            error: function (e, jqxhr, settings, exception) {
                LAYER_MSG_('加载失败', 2);
            }
        });
    });

    // 点击添加岑略组
    $('input[name="addPolicyGroups"]').click(function () {
        // 页面加载的时候获取定向人群
        var dataUrl;
        dataUrl = $(this).attr('data-url');
        $.ajax({
            url: dataUrl,
            type: 'get',
            data: {},
            dataType: 'json',
            success: function (res) {
                for (var i = 0; i < res.data.length; i++) {
                    $('select[name="target_name_selects"]').append('<option value="' + res.data[i].target_name + '" class="' + res.data[i].target_id + '">' + res.data[i].target_name + '</option>');
                }

                $('.selectpicker').selectpicker('refresh');
                $('.selectpicker').selectpicker('render');
            },
            error: function () {
                console.log('网络异常 请稍后再试');
            }
        });
    });

    // Bootstrap-select下拉多选获取选中的数据
    $('select[name="target_name_selects"]').change(function () {
        var id = "", staffs = [], staffNameStr = "", cardHtml = '';

        //循环的取出插件选择的元素(通过是否添加了selected类名判断)
        for (var i = 0; i < $("li.selected").length; i++) {
            //通过选择器和筛选条件找到title和ID
            id = $("li.selected").eq(i).find("a").attr("class");
            staffNameStr = $("li.selected").eq(i).find(".text").html();

            //以键值对的形式加到数组中去
            staffs.push({
                targetId: id,
                targetName: staffNameStr
            });

            cardHtml += '<li class="list-group-item">' + staffNameStr + '</li>';
        }

        //将包含对象的数组转换成json格式
        var staffStr = JSON.stringify(staffs);

        //赋值给隐藏的Input域
        if (staffStr.length > 0) {
            $('input[name="taskStaffs"]').val(staffStr);
            $('input[name="cardHtml"]').val(cardHtml);
        } else {
            $('input[name="taskStaffs"]').val('');
            $('input[name="cardHtml"]').val('');
        }

    });

    // 全选 反选
    $('.strategyGroup').on('click', '#select-all', function () {
        var checkbox = $(".check-box");
        if ($(this).is(':checked')) {
            checkbox.prop("checked", true);
        } else {
            checkbox.prop("checked", false);
        }
    });

    // 点击添加到 div 里面 发送ajax 提交数据
    $('.addSurveyGroupOperateConfirm').click(function () {
        var targetName, surveyGroupLength, dataJsonStr, dataJson;
        targetName = $('input[name="target_name"]').val();
        if (targetName == '') {
            LAYER_MSG('请正确填写策略组名称');
            return false;
        }

        // 策略组最多只能添加 9 个  这里只能通过 session 来判断
        surveyGroupLength = $('.survey-group .card').length;
        if (surveyGroupLength > 8) {
            LAYER_MSG('策略组只能添加9个');
            return false;
        }

        var htmlStr = '<div class="card">';
        htmlStr += '<div class="strategic-group"><span class="list-group-item active">';
        htmlStr += '<a href="javascript:;" class="badge del-strategic-group"><i class="fa fa-times">删除</i></a>';
        htmlStr += '<a href="javascript:;" class="badge edit-strategic-group"><i class="fa fa-edit">编辑</i></a>';
        htmlStr += '<h4 class="list-group-item-heading">' + targetName + '</h4></span></div><div class="pre-scrollable"><ul class="list-group">';
        htmlStr += $('input[name="cardHtml"]').val();
        htmlStr += '</ul></div></div>';

        dataJsonStr = $('input[name="taskStaffs"]').val();

        dataJsonStr = '{"' + targetName + '":[' + dataJsonStr.substring(1);
        dataJsonStr = dataJsonStr.substring(0, dataJsonStr.length - 1) + ']}';

        // ajax 提交策略组信息
        $.ajax({
            url: 'ajax-save-strategy-group.html',
            type: 'post',
            data: JSON.parse(dataJsonStr), // 字符串转 json 对象
            dataType: 'json',
            beforeSend: function () {
            },
            success: function (response) {
                if (response.result == "true") {
                    // 隐藏未添加策略组
                    $('.not-added-policy-group').css('display', 'none');

                    // 清空策略组名称
                    $('input[name="target_name"]').val('');

                    // 清空cardHtml
                    $('input[name="cardHtml"]').val('');

                    $('.survey-group').append(htmlStr);
                    layer.closeAll();
                } else {
                    LAYER_MSG_('加载失败', 2);
                }

            },
            error: function (e, jqxhr, settings, exception) {
                LAYER_MSG_('加载失败', 2);
            }
        });
    });

    // 删除
    $('.survey-group').on('click', '.del-strategic-group', function () {
        var targetName = $(this).parent().find('h4').html(); // 查找当前点击的父元素的 h4 标签 html

        var parentDom = $(this).parents('.card'); // parent 和 parents(找到某一特定的祖先元素): 只能找上一级别
        parentDom.remove();

        var cardLength = $('.survey-group').children('.card').length; // 获取 div 的个数
        if (cardLength <= 0) {
            $('.no-policy-groups-added').removeClass('dpn');
        }

        $.ajax({
            url: 'ajax-del-strategy-group.html',
            type: 'post',
            data: {'targetName': targetName}, // 字符串转 json 对象
            dataType: 'json',
            beforeSend: function () {
            },
            success: function (response) {
                if (response.result != "true") {
                    LAYER_MSG_('加载失败', 2);
                }

            },
            error: function (e, jqxhr, settings, exception) {
                LAYER_MSG_('加载失败', 2);
            }
        });
    });

    // 生成报表
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

    // 上一步
    $('.last-step').on('click', function () {
        $('.nav-tabs li').eq(1).removeClass('active').siblings('li').addClass('disabled');
        $('.nav-tabs li').eq(0).addClass('active');
        $('.tab-pane').eq(1).removeClass('active in');
        $('.tab-pane').eq(0).addClass('active in');
    });
});