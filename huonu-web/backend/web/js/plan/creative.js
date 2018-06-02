$(function () {

    var page = 1;
    var creativeLevel = new Array();
    creativeLevel[1] = '一级';
    creativeLevel[2] = '二级';
    creativeLevel[3] = '三级';
    creativeLevel[4] = '四级';
    creativeLevel[10] = '十级';
    creativeLevel[99] = '未分级';

    var creativeSize, creativeLevels, auditStatus, creativeName;

    // 获取创意
    getCreativeList(page);

    function getCreativeList(page) {
        var dataUrl = $('.chooseCreativeLibrary').attr('data-url');
        creativeSize = $('select[name="creativeSize"] option:selected').val();
        creativeLevels = $('select[name="creativeLevel"] option:selected').val();
        auditStatus = $('select[name="auditStatus"] option:selected').val();
        creativeName = $('input[name="creativeName"]').val();
        $.ajax({
            url: dataUrl,
            type: 'get',
            data: {
                'page': page,
                'creativeSize': creativeSize,
                'creativeLevel': creativeLevels,
                'auditStatus': auditStatus,
                'creativeName': creativeName,
            },
            success: function (response) {
                if (response.result == true) {
                    var data = response.data.taobaoZsCreative;
                    var html = '';
                    $.each(data, function (i, v) {
                        html += '<li class="fl">' +
                            '<div class="creativeImg">' +
                            '<div class="inline-block">' +
                            '<img src="' + v.image_path + '" style="width: 200px; height: 50px; max-width: 200px; max-height: 98px;">' +
                            '</div></div>' +
                            '<div class="iconLine clearfix">' +
                            '<span class="fl bold" style="width: 66px; overflow: hidden;">' + v.creative_size + '</span>' +
                            '<span class="fr">' + creativeLevel[v.creative_level] + '</span>' +
                            '</div>' +
                            '<label class="iconLine">' +
                            '<input name="toggleOne" class="toggleOne" value="' + v.creative_id + '" type="checkbox" data-src="' + v.image_path + '" data-click-url="' + v.click_url + '">' +
                            '<span title="' + v.creative_name + '">' + v.creative_name + '</span>' +
                            '</label></li>';
                    });
                    $('.creativeIcons').html(html);

                    var pageHtml = '<ul class="pagination">';
                    var count = response.data.taobaoZsCreativePageCount;
                    for (var j = 1; j <= count; j++) {
                        //输出分页链接
                        if (page == j) pageHtml += '<li class="cp active"><a data="' + j + '">' + j + '</a></li>';
                        else pageHtml += '<li class="cp"><a data="' + j + '">' + j + '</a></li>';
                    }

                    pageHtml += '</ul>';
                    $(".creativePage").html(pageHtml);
                } else {
                    console.log('服务器错误');
                }
            },
            error: function (e, jqxhr, settings, exception) {
                console.log('加载失败');
            }
        });
    }

    $(".creativePage").on('click', 'a', function () {   //为a标签动态绑定事件
        var page = $(this).attr("data");  //获取链接里的页码
        creativeSize = $('select[name="creativeSize"] option:selected').val();
        creativeLevels = $('select[name="creativeLevel"] option:selected').val();
        auditStatus = $('select[name="auditStatus"] option:selected').val();
        creativeName = $('input[name="creativeName"]').val();
        getCreativeList(page, creativeSize, creativeLevels, auditStatus, creativeName);
    });

    $("select[name='creativeSize']").change(function () {
        creativeSize = $('select[name="creativeSize"] option:selected').val();
        creativeLevels = $('select[name="creativeLevel"] option:selected').val();
        auditStatus = $('select[name="auditStatus"] option:selected').val();
        creativeName = $('input[name="creativeName"]').val();
        getCreativeList(page, creativeSize, creativeLevels, auditStatus, creativeName);
    });

    $("select[name='creativeLevel']").change(function () {
        creativeSize = $('select[name="creativeSize"] option:selected').val();
        creativeLevels = $('select[name="creativeLevel"] option:selected').val();
        auditStatus = $('select[name="auditStatus"] option:selected').val();
        creativeName = $('input[name="creativeName"]').val();
        getCreativeList(page, creativeSize, creativeLevels, auditStatus, creativeName);
    });

    $("select[name='auditStatus']").change(function () {
        creativeSize = $('select[name="creativeSize"] option:selected').val();
        creativeLevels = $('select[name="creativeLevel"] option:selected').val();
        auditStatus = $('select[name="auditStatus"] option:selected').val();
        creativeName = $('input[name="creativeName"]').val();
        getCreativeList(page, creativeSize, creativeLevels, auditStatus, creativeName);
    });

    $("input[name='creativeName']").blur(function () {
        creativeSize = $('select[name="creativeSize"] option:selected').val();
        creativeLevels = $('select[name="creativeLevel"] option:selected').val();
        auditStatus = $('select[name="auditStatus"] option:selected').val();
        creativeName = $('input[name="creativeName"]').val();
        getCreativeList(page, creativeSize, creativeLevels, auditStatus, creativeName);
    });

    // 全选
    $('.creativeSelectAll').click(function () {
        var checkbox = $(".toggleOne");
        if ($(this).is(':checked')) {
            checkbox.prop("checked", true);
        } else {
            checkbox.prop("checked", false);
        }
    });

    // 点击确认
    $('.creative-confirm').click(function () {
        var html = '', creativeIds = new Array();
        $("input[name='toggleOne']").each(function () {
            var _this = $(this);
            if (_this.is(':checked')) {
                var dataSrc = _this.attr('data-src');
                var dataClickUrl = _this.attr('data-click-url');
                var creativeId = _this.val();
                html += '<div class="boxCreative fl mb20 mr26">' +
                    '<div class="creativeImg">' +
                    '<div class="inline-block">' +
                    '<img src="' + dataSrc + '" style="width: 100%; height: 120px; max-width: 100%; max-height: 120px;">' +
                    '</div></div>' +
                    '<div class="pic-preview hide">' +
                    '<img src="' + dataSrc + '" style="max-width:100%; max-height:200px;">' +
                    '</div>' +
                    '<div class="creativeEdit">' +
                    '<span class="fl lh24 s_fc_9">审核通过</span>' +
                    '<a class="creativeBtn fr ml5 creativeDel" href="javascript:;">' +
                    '<i class="fa fa-trash-o"></i>' +
                    '<span class="btnTip" data-value="' + creativeId + '">删除</span>' +
                    '</a>' +
                    '<a class="creativeBtn fr" href="' + dataClickUrl + '" target="_blank">' +
                    '<i class="fa fa-share"></i>' +
                    '<span class="btnTip">前往落地页</span>' +
                    '</a></div></div>';

                var index = $.inArray(_this.val(), creativeIds);
                if (index < 0) {
                    creativeIds.push(_this.val());
                }
            }
        });

        if (html != '') {
            $('.boxCreatives').append(html);
            $('input[name="creativeIdList"]').val(creativeIds);
        }
    });

    // 移动显示大图
    $('.boxCreatives').on('mouseenter', '.creativeImg', function () {
        // 绑定鼠标进入事件
        $(this).mousemove(function (e) {
            $(this).siblings().css({
                "top": (e.pageY - 190) + "px",
                "left": (e.pageX - 200) + "px"
            }).removeClass('hide')
        });
    });
    $('.boxCreatives').on('mouseleave', '.creativeImg', function () {
        // 绑定鼠标划出事件
        $(this).next('div').addClass('hide');
    });

    // 移除全部
    $('.creativeDels').click(function () {
        $('.boxCreatives').html('');

        $('input[name="creativeIdList"]').val('');
    });

    // 删除单个
    $('.boxCreatives').on('click', '.creativeDel', function () {
        var creativeIdList, _this, index, creativeId;
        _this = $(this);
        creativeId = _this.attr('data-value');
        _this.parent('div').parent('div').remove();

        creativeIdList = $('input[name="creativeIdList"]').val().split(',');

        creativeIdList.splice($.inArray(creativeId, creativeIdList), 1);

        $('input[name="creativeIdList"]').val(creativeIdList);
    });

    // 保存 创意
    $('.create-creative').click(function () {
        var creativeIdList, dataUrl, creativeIdListThis = $('input[name="creativeIdList"]'), dataSavePlan;
        creativeIdList = creativeIdListThis.val();
        dataUrl = creativeIdListThis.attr('data-url');
        dataSavePlan = creativeIdListThis.attr('data-save-plan');

        $.ajax({
            url: dataUrl,
            type: 'get',
            data: {
                'creativeIdList': creativeIdList
            },
            success: function (response) {
                if (response.result == true) {

                    $.ajax({
                        url: dataSavePlan,
                        type: 'post',
                        data: {},
                        success: function (response) {
                            LAYER_MSG__(response.data);
                        },
                        error: function (e, jqxhr, settings, exception) {
                            LAYER_MSG_('服务器错误', 2);
                        }
                    });

                } else {
                    LAYER_MSG_('服务器错误', 2);
                }
            },
            error: function (e, jqxhr, settings, exception) {
                LAYER_MSG_('加载失败', 2);
            }
        });
    });

    getSessionCreative();

    function getSessionCreative() {
        var dataUrl, html = '', data;
        dataUrl = $('input[name="getSessionCreative"]').attr('data-url');
        $.ajax({
            url: dataUrl,
            type: 'get',
            data: {},
            success: function (response) {
                if (response.result == true) {
                    data = response.data.taobaoZsCreatives
                    $.each(data, function (i, v) {
                        html += '<div class="boxCreative fl mb20 mr26"><div class="creativeImg"><div class="inline-block"><img src="' + v.image_path + '" style="width: 100%; height: 120px; max-width: 100%; max-height: 120px;"></div></div><div class="pic-preview hide"><img src="' + v.image_path + '" style="max-width:100%; max-height:200px;"></div><div class="creativeEdit"><span class="fl lh24 s_fc_9">审核通过</span><a class="creativeBtn fr ml5 creativeDel" href="javascript:;"><i class="fa fa-trash-o"></i><span class="btnTip" data-value="' + v.creative_id + '">删除</span></a><a class="creativeBtn fr" href="' + v.click_url + '" target="_blank"><i class="fa fa-share"></i><span class="btnTip">前往落地页</span></a></div></div>';
                    });

                    $('.boxCreatives').html(html);
                    $('input[name="creativeIdList"]').val(response.data.creativeIdList);
                }
            },
            error: function (e, jqxhr, settings, exception) {
                LAYER_MSG_('加载失败', 2);
            }
        });
    }

    // 返回上一步
    $('.creative-last-step').click(function () {
        $('.nav-tabs li').eq(2).removeClass('active').siblings('li').addClass('disabled');
        $('.nav-tabs li').eq(1).addClass('active');
        $('.tab-pane').eq(2).removeClass('active in');
        $('.tab-pane').eq(1).addClass('active in');
    });
});