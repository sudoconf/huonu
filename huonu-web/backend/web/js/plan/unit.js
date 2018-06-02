$(function () {

    var page = 1;

    // 相似宝贝定向
    getSimilarBabyList(page, '');

    function getSimilarBabyList(page, similarBabyName) {
        var dataUrl = $('.similar-baby-orientation').attr('data-url');
        $.ajax({
            url: dataUrl,
            type: 'get',
            data: {
                'similarBabyName': similarBabyName,
                'page': page
            },
            success: function (response) {
                if (response.result == true) {
                    var data = response.data.items;
                    var html = '';
                    $.each(data, function (i, v) {
                        html += '<tr class="cp">' +
                            '<th><input class="bx-anim-radio" type="radio" name="similar-radios" value="' + v.item_id + '" data-title="' + v.item_name + '"></th>' +
                            '<td><div class="similar-img fl"><img src="' + v.item_pic_url + '" style="width: 70px; max-width: 70px"></div></td>' +
                            '<td><a target="_blank" href="' + v.item_landing_page + '">' + v.item_name + '</a></td>' +
                            '<td></td>' +
                            '<td></td>' +
                            '</tr>';
                    });
                    $('.similarBabyOrientationTable').html(html);

                    var pageHtml = '<nav aria-label="Page navigation"><ul class="pagination">';
                    var count = response.data.page;
                    for (var j = 1; j <= count; j++) {
                        //输出分页链接
                        if (page == j) pageHtml += '<li class="cp active"><a data="' + j + '">' + j + '</a></li>';
                        else pageHtml += '<li class="cp"><a data="' + j + '">' + j + '</a></li>';
                    }

                    pageHtml += '</ul></nav>';
                    $(".similarBabyOrientationPage").html(pageHtml);
                } else {
                    console.log('服务器错误');
                }
            },
            error: function (e, jqxhr, settings, exception) {
                console.log('加载失败');
            }
        });
    }

    $(".similarBabyOrientationPage").on('click', 'a', function () {   //为a标签动态绑定事件
        var page = $(this).attr("data");  //获取链接里的页码
        var similarBabyName = $('.similar-baby-name').val();
        getSimilarBabyList(page, similarBabyName);
    });

    $('.similar-baby-orientation-search').click(function () {
        var similarBabyName = $('.similar-baby-name').val();
        getSimilarBabyList(page, similarBabyName);
    });

    // 获取达摩盘定向列表
    getDamDiskList(page);

    function getDamDiskList(page, dmpCrowdName) {

        var dataUrl = $('.damo-disk-orientation').attr('data-url');
        $.ajax({
            url: dataUrl,
            type: 'get',
            data: {
                'dmpCrowdName': dmpCrowdName,
                'page': page
            },
            success: function (response) {

                if (response.result == true) {

                    var data = response.data.taobaoZsDmp;
                    var html = '';
                    $.each(data, function (i, v) {
                        html += '<tr>' +
                            '<th><input type="checkbox" name="damoDisk" value="' + v.dmp_crowd_id + '" data-title="' + v.dmp_crowd_name + '"></th>' +
                            '<td>' + v.dmp_crowd_name + '</td>' +
                            '<td>' + v.dmp_crowd_name + '</td>' +
                            '<td></td>' +
                            '<td>' + v.coverage + '</td>' +
                            '<td>' + v.update_time + '</td>' +
                            '</tr>';
                    });
                    $('.damoDiskOrientationTable').html(html);

                    var pageHtml = '<nav aria-label="Page navigation"><ul class="pagination">';

                    var count = response.data.taobaoZsDmpPageCount;
                    for (var j = 1; j <= count; j++) {
                        //输出分页链接
                        if (page == j) pageHtml += '<li class="cp active"><a data="' + j + '">' + j + '</a></li>';
                        else pageHtml += '<li class="cp"><a data="' + j + '">' + j + '</a></li>';
                    }

                    pageHtml += '</ul></nav>';
                    $(".damoDiskOrientationPage").html(pageHtml);

                } else {
                    console.log('服务器错误');
                }

            },
            error: function (e, jqxhr, settings, exception) {
                console.log('加载失败');
            }
        });

    }

    $(".damoDiskOrientationPage").on('click', 'a', function () {   //为a标签动态绑定事件
        var page = $(this).attr("data");  //获取链接里的页码
        var dmpCrowdName = $('.dmp-crowd-name').val();
        getDamDiskList(page, dmpCrowdName);
    });

    $('.damo-disk-orientation-search').click(function () {
        var dmpCrowdName = $('.dmp-crowd-name').val();
        getDamDiskList(page, dmpCrowdName);
    });

    // 访客定向 - 添加种子店铺
    $('.add-seed-shop').click(function () {
        if ($(this).is(':checked')) {
            $('.add-seed-shop-div').removeClass('dpn');
        } else {
            $('.add-seed-shop-div').addClass('dpn');
        }
    });

    // 类目型定向-高级兴趣点
    function getClassOrientationAdvancedInterestPoint(interestName) {
        var dataUrl = $('.class-orientation-advanced-interest-point').attr('data-url');
        $.ajax({
            url: dataUrl,
            type: 'get',
            data: {
                'interestName': interestName
            },
            success: function (response) {
                if (response.result == true) {
                    var data = response.data;
                    var html = '';
                    $.each(data, function (i, v) {
                        html += '<li class="clearfix">' +
                            '<div class="hover-td pdr10"><div style="width: 100px;" class="hover-ellipsis">' + v.option_name + '</div></div>' +
                            '<div class="hover-td pdr10"><div style="width: 100px;" class="hover-ellipsis">' + v.cat_name + '</div></div>' +
                            '<div class="hover-td" style="width: 82px;"><div class="relative-contain"><span class="relative-over width5">暂无</span></div></div>' +
                            '<div class="hover-td"><div style="width: 76px;" class="hover-ellipsis"><span class="font-tahoma bold">暂无</span></div>' +
                            '</div>' +
                            '<div class="hover-td hover-add cp" data-value="' + v.option_value + '">添加</div>' +
                            '</li>';
                    });
                    $('.class-orientation-advanced-interest-point-ul').html(html);

                } else {
                    console.log('服务器错误');
                }
            },
            error: function (e, jqxhr, settings, exception) {
                console.log('加载失败');
            }
        });
    }

    $('.seniorInterest').click(function () {
        var interestName = $('input[name="interestName"]').val();
        getClassOrientationAdvancedInterestPoint(interestName);
    });

    // 当模态框完全对用户隐藏时触发
    $('#classOrientationAdvancedInterestPoint').on('hidden.bs.modal', function () {
        getClassOrientationAdvancedInterestPoint('');
        $('.class-orientation-advanced-interest-point-ul-r').html('');
    });
    // 在调用 show 方法后触发
    $('#classOrientationAdvancedInterestPoint').on('show.bs.modal', function () {
        getClassOrientationAdvancedInterestPoint('');
    });

    // 点击添加
    $('.class-orientation-advanced-interest-point-ul').on('click', '.hover-add', function () {
        var liLength = $('.class-orientation-advanced-interest-point-ul-r li').length;
        if (liLength > 100) {
            LAYER_MSG('最多添加50个');
        }
        var selectedNumber = liLength + 1;
        var selectedNumberStr = '已选个数 ' + selectedNumber + '/50';

        var _this = $(this);
        var optionName = _this.siblings().eq(0).children('div').text();
        var catName = _this.siblings().eq(1).children('div').text();
        var populationCorrelation = _this.siblings().eq(2).children('div').text();
        var crowdNumber = _this.siblings().eq(3).children('div').text();
        var optionValue = _this.attr('data-value');

        var html = '<li class="key-result-item clearfix">' +
            '<div class="fl mr5" style="width: 100px;" title="' + optionName + '">' + optionName + '</div>' +
            '<div class="fl mr5" style="width: 100px;" title="' + catName + '">' + catName + '</div>' +
            '<div class="fl" style="width: 82px;"><div class="relative-contain"><span class="relative-over width5">' + populationCorrelation + '</span></div></div>' +
            '<div class="fl" style="width: 76px;"><span class="font-tahoma bold">' + crowdNumber + '</span></div>' +
            '<div class="fr cp s_fc_9 hover-remove" data-value="' + optionValue + '">移除</div>' +
            '</li>';

        _this.parent('li').addClass('s_fc_ct');
        _this.html('');

        $('.selected-number').html(selectedNumberStr);

        $('.class-orientation-advanced-interest-point-ul-r').append(html);
    });

    // 点击添加全部
    $('.hover-add-all').click(function () {
        var liLength = $('.class-orientation-advanced-interest-point-ul-r li').length;
        if (liLength > 100) {
            LAYER_MSG('最多添加50个');
        }

        var html = '';
        $('.class-orientation-advanced-interest-point-ul li').each(function (i, v) {

            var _this = $(this);
            var optionName = _this.find('div').eq(0).children('div').text();
            var catName = _this.find('div').eq(2).children('div').text();
            var populationCorrelation = _this.find('div').eq(4).children('div').text();
            var crowdNumber = _this.find('div').eq(6).children('div').text();
            var optionValue = _this.find('div:last').attr('data-value');
            html += '<li class="key-result-item clearfix">' +
                '<div class="fl mr5" style="width: 100px;" title="' + optionName + '">' + optionName + '</div>' +
                '<div class="fl mr5" style="width: 100px;" title="' + catName + '">' + catName + '</div>' +
                '<div class="fl" style="width: 82px;"><div class="relative-contain"><span class="relative-over width5">' + populationCorrelation + '</span></div></div>' +
                '<div class="fl" style="width: 76px;"><span class="font-tahoma bold">' + crowdNumber + '</span></div>' +
                '<div class="fr cp s_fc_9 hover-remove" data-value="' + optionValue + '">移除</div>' +
                '</li>';

            _this.addClass('s_fc_ct');
            _this.find('div:last').html('');
        });

        $('.class-orientation-advanced-interest-point-ul-r').html(html);

        var liLength1 = $('.class-orientation-advanced-interest-point-ul-r li').length;
        var selectedNumberStr = '已选个数 ' + liLength1 + '/50';
        $('.selected-number').html(selectedNumberStr);
    });

    // 移除单个
    $('.class-orientation-advanced-interest-point-ul-r').on('click', '.hover-remove', function () {
        var _this = $(this);
        _this.parent('li').remove();

        var dataValue = _this.attr('data-value');

        var liLength = $('.class-orientation-advanced-interest-point-ul-r li').length;
        var selectedNumberStr = '已选个数 ' + liLength + '/50';

        $('.class-orientation-advanced-interest-point-ul li').each(function (i, v) {
            var _LThis = $(this);
            var dataValueStr = _LThis.find('div:last').attr('data-value');

            if (dataValueStr == dataValue) {
                _LThis.find('div:last').text('添加');
                _LThis.removeClass('s_fc_ct');
            }
        });

        $('.selected-number').html(selectedNumberStr);
    });

    // 点击全部移除
    $('.hover-remove-all').click(function () {
        var UlRLi = $('.class-orientation-advanced-interest-point-ul-r li');
        var liLength = UlRLi.length;
        if (liLength <= 0) {
            LAYER_MSG('暂无移除项');
        }

        UlRLi.each(function (i, v) {
            var _LThis = $(this);
            _LThis.remove();
            var dataValueStr = _LThis.find('div:last').attr('data-value');
            $('.class-orientation-advanced-interest-point-ul li').each(function (i, v) {
                var _this = $(this);
                var optionValue = _this.find('div:last').attr('data-value');
                if (dataValueStr == optionValue) {
                    _this.find('div:last').text('添加');
                    _this.removeClass('s_fc_ct');
                }
            });
        });

        var liLength = $('.class-orientation-advanced-interest-point-ul-r li').length;
        var selectedNumberStr = '已选个数 ' + liLength + '/50';
        $('.selected-number').html(selectedNumberStr);
    });

    // 获取资源位搜索条件
    getResourcesCondition();

    function getResourcesCondition() {
        var dataUrl = $('.resource-list').attr('data-url');
        $.ajax({
            url: dataUrl,
            type: 'get',
            data: {},
            success: function (response) {
                if (response.result == true) {
                    var data = response.data;
                    var htmlStr = '';
                    $.each(data, function (i, v) {

                        htmlStr += '<li class="groupItems">' +
                            '<div class="mb5">' +
                            '<label><input class="mr5" name="' + v.condition_field_name + '[]" type="checkbox"><span class="s_fs_12 s_fc_9">' + v.condition_name + '</span></label>' +
                            '</div>' +
                            '<ul>';

                        $.each(v.children, function (it, iv) {
                            htmlStr += '<li>' +
                                '<label><input type="checkbox" name="' + iv.condition_field_name + '[]" value="' + iv.condition_value + '" class="mr5"> ' + iv.condition_name + ' </label>' +
                                '</li>';
                        })

                        htmlStr += '</ul></li>';
                    })

                    $('.resource-list-ul').html(htmlStr);
                } else {
                    console.log('服务器错误');
                }
            },
            error: function (e, jqxhr, settings, exception) {
                console.log('加载失败');
            }
        });
    }

    // 获取资源位列表
    getResources(page, '');

    function getResources(page, adzoneName) {
        var dataUrl = $('.resource-list').attr('data-resources-url');
        $.ajax({
            url: dataUrl,
            type: 'get',
            data: {
                'adzoneName': adzoneName,
                'page': page
            },
            success: function (response) {
                if (response.result == true) {
                    var data = response.data.taobaoZsAdzones;
                    var htmlStr = '';
                    $.each(data, function (i, v) {
                        htmlStr += '<tr>' +
                            '<th><input class="resources-checkbox" name="resourcesCheckbox" type="checkbox" value="' + v.adzone_id + '" data-title="' + v.adzone_name + '"></th>' +
                            '<td>' + v.adzone_name + '</td>' +
                            '<td>--</td>' +
                            '<td>' + v.adzone_level + '</td>' +
                            '<td>' + v.allow_ad_format_list + '</td>' +
                            '<td><span class="text-overflow adzoneSizeListTd">' + v.adzone_size_list + '</span></td>' +
                            '<td>--</td>' +
                            '<td>--</td>' +
                            '<td>--</td>' +
                            '<td>--</td>' +
                            '<td>--</td>' +
                            '<td>--</td>' +
                            '<td>--</td>' +
                            '<td>--</td>' +
                            '</tr>';
                    });

                    $('.resource-list-model-tr').html(htmlStr);

                    var pageHtml = '<nav aria-label="Page navigation"><ul class="pagination">';

                    var count = response.data.taobaoZsAdzonePageCount;
                    for (var j = 1; j <= count; j++) {
                        //输出分页链接
                        if (page == j) pageHtml += '<li class="cp active"><a data="' + j + '">' + j + '</a></li>';
                        else pageHtml += '<li class="cp"><a data="' + j + '">' + j + '</a></li>';
                    }

                    pageHtml += '</ul></nav>';
                    $(".resource-list-model-page").html(pageHtml);
                } else {
                    console.log('服务器错误');
                }
            },
            error: function (e, jqxhr, settings, exception) {
                console.log('加载失败');
            }
        });
    }

    $(".resource-list-model-page").on('click', 'a', function () {   //为a标签动态绑定事件
        var page = $(this).attr("data");  //获取链接里的页码
        var adzoneName = $('input[name="adzoneName"]').val();
        getResources(page, adzoneName);
    });

    $('.resource-list-model-search').click(function () {
        var adzoneName = $('input[name="adzoneName"]').val();
        getResources(page, adzoneName);
    });

    // 相似宝贝定向 添加
    $('.similarBabyOrientationConfirm').click(function () {
        var _this = $("input[name='similar-radios']:checked");
        var dataValue = _this.val();
        var dataTitle = _this.attr('data-title');
        var html = '<div class="mt10 clearfix">' +
            '<div class="target-choose-result-item">' +
            '<span>喜欢相似宝贝的人群：' + dataTitle + '</span>' +
            '<a class="delete" href="javascript:;"><i class="fa fa-times"></i></a>' +
            '</div>' +
            '</div>';

        $('.similarBabyOrientationDiv').removeClass('dpn');
        $('.similarBabyOrientationDiv').html(html);
    });
    $('.similarBabyOrientationDiv').on('click', '.delete', function () {
        var _this = $(this);
        _this.parent("div").parent("div").remove();
        var similarBabyOrientationDiv = $('.similarBabyOrientationDiv').find('div').length;
        if (similarBabyOrientationDiv == 0) {
            $('.similarBabyOrientationDiv').addClass('dpn')
        }
    });

    // 达摩盘定向 添加
    $('.damoDiskOrientationConfirm').click(function () {
        var html = '';
        $("input[name='damoDisk']").each(function () {
            var _this = $(this);
            if (_this.is(':checked')) {
                var dataValue = _this.val();
                var dataTitle = _this.attr('data-title');
                html += '<div class="target-choose-result-item">' +
                    '<span>' + dataTitle + '</span>' +
                    '<a class="delete" href="javascript:;" data-value="' + dataValue + '">' +
                    '<i class="fa fa-times"></i>' +
                    '</a>' +
                    '</div>';
            }
        });

        if (html != '') {
            $('#target_premium_128').removeClass('dpn');
            $('#target_premium_128').children("div:first-child").html(html);
        }

        setPriceShowOrHide();
    });

    // 删除达摩盘定向
    $('#target_premium_128').children("div:first-child").on('click', '.delete', function () {
        var _this = $(this);
        _this.parent("div").remove();

        var dmpOrientationDiv = $('#target_premium_128').children("div:first-child").find('div').length;
        if (dmpOrientationDiv == 0) {
            $('#target_premium_128').addClass('dpn')
        }

        setPriceShowOrHide();
    });

    // 获取资源位列表 全选、反选
    $('.resourceListSelectAll').click(function () {
        var checkbox = $(".resources-checkbox");
        if ($(this).is(':checked')) {
            checkbox.prop("checked", true);
        } else {
            checkbox.prop("checked", false);
        }
    });

    // 添加获取资源位列表 到div
    $('.resource-list-confirm').click(function () {
        var html = '';
        $("input[name='resourcesCheckbox']").each(function () {
            var _this = $(this);
            if (_this.is(':checked')) {
                var dataTitle = _this.attr('data-title');
                var adzoneId = _this.val();
                var adzoneSizeList = _this.parent('th').siblings('td').eq(4).html();
                html += '<tr>' +
                    '<th><input value="' + adzoneId + '" type="checkbox" class="resources-checkbox" checked></th>' +
                    '<td>' + dataTitle + '</td>' +
                    '<td>--</td>' +
                    '<td>--</td>' +
                    '<td>--</td>' +
                    '<td>--</td>' +
                    '<td>' + adzoneSizeList + '</td>' +
                    '<td><span class="btn btn-gray resource-del">移除</span></td>' +
                    '</tr>';
            }
        });

        if (html != '') {
            $('.no-resource-selected-div').addClass('dpn');
            $('.resource-list-div').removeClass('dpn');
            $('.resource-list-table-tr').append(html);
        }

        setPriceShowOrHide();
    });

    // 删除单个资源位
    $('.resource-list-table-tr').on('click', '.resource-del', function () {
        var _this = $(this);
        _this.parent().parent('tr').remove();

        var trLength = $('.resource-list-table-tr tr').length;
        if (trLength == 0) {
            $('.no-resource-selected-div').removeClass('dpn');
            $('.resource-list-div').addClass('dpn');
        }

        setPriceShowOrHide();
    });

    // 删除全部资源位
    $('.resource-dels').click(function () {
        $('.resource-list-table-tr').html('');
        $('.no-resource-selected-div').removeClass('dpn');
        $('.resource-list-div').addClass('dpn');

        setPriceShowOrHide();
    });

    // 是否显示 设置出价
    function setPriceShowOrHide() {
        if ($('#target_premium_128').children('div').children('div').length > 0 && $('.resource-list-table-tr tr').length > 0) {

            var html = '';
            // 添加出价列表
            $('#target_premium_128').children('div').children('div').each(function (i, v) {
                var _this = $(this);
                var title = _this.children('span').html();
                var crowdValue = _this.children('a').attr('data-value');

                html += '<div class="control-group form-inline pb60 bid-div"><div class="col-md-12" data-value="' + crowdValue + '"><div class="text-overflow col-md-5 lh35">' +
                    '<label class="mr10">' +
                    '<input class="mr5" type="checkbox" checked name="type" value="1">' +
                    '</label>' +
                    '<i class="fa fa-minus-circle cp hideAdzone" data-value="1"></i>' +
                    '<span class="ml5">达摩盘_平台精选：' + title + '</span>' +
                    '</div>' +
                    '<div class="col-md-7">' +
                    '<div class="col-md-offset-2 col-md-10 pl40">' +
                    '<label class="mr10">' +
                    '<span class="ml5">批量出价</span>' +
                    '<i class="fa fa-question-circle tips-help"></i>' +
                    '</label>' +
                    '<div class="input-group wi100 mr30">' +
                    '<input type="text" class="form-control batch-offer-input batch-offer-input-head">' +
                    '<span class="input-group-addon">元</span>' +
                    '</div><span class="errorHeadNumber dpn">*请输入数字，精确到小数点后两位。</span></div>' +
                    '</div></div><div class="col-md-12 hideAdzoneUl"><ul class="ml40">';

                $('.resource-list-table-tr tr').each(function () {
                    var _tThis = $(this);
                    var tTitle = _tThis.children('th').next('td').html();
                    var adzoneId = _tThis.children('th').children('input').val();
                    var adzoneSizeList = _tThis.children('td').eq(5).html();
                    html += '<li style="height: 52px;" data-adzoneId="' + adzoneId + '">' +
                        '<div class="text-overflow col-md-5 lh35 s_fc_9" data-adzoneId="">' + tTitle + ' 尺寸：' + adzoneSizeList + '</div>' +
                        '<div class="col-md-7">' +
                        '<div class="col-md-offset-2 col-md-10" style="padding-left: 65px">' +
                        '<span class="ml5 mr10">出价</span>' +
                        '<div class="input-group wi100 mr30">' +
                        '<input name="price" type="text" class="form-control batch-offer-input">' +
                        '<span class="input-group-addon">元</span>' +
                        '</div>' +
                        '<span class="errorNul dpn">*请填写出价</span><span class="errorNumber dpn">*请输入数字，精确到小数点后两位。</span>' +
                        '</div>' +
                        '</div>' +
                        '</li>';
                });

                html += '</ul></div></div>';
            });

            $('.set-price-div').html(html);

            $('.handle-unit-crossover-premium').addClass('dpn');
            $('.set-price').removeClass('dpn');
        } else {

            // 删除出价列表
            $('.set-price-div').html('');

            $('.handle-unit-crossover-premium').removeClass('dpn');
            $('.set-price').addClass('dpn');
        }
    }

    // 批量出价
    $('.batch-offer-confirm').click(function () {
        var value = $('.batch-offer').val();
        $('.batch-offer-input').val(value);
    });

    // 检测
    function checkSh() {
        var i = 0;
        $('.set-price-div').each(function () {
            var _this = $(this);
            if (_this.children('div').children('div').next('div').hasClass('dpn')) {
                i = i + 1;
            }
        });
        if (i > 0) {
            $('.all-expanded-or-closed').html('全部展开');
        } else {
            $('.all-expanded-or-closed').html('全部收起');
        }
    }

    // 点击收起、展开
    $('.set-price').on('click', '.hideAdzone', function () {
        var _this = $(this);
        if (_this.attr('data-value') == 1) {
            // 等于1 就收起
            _this.parent('div').parent('div').siblings('.hideAdzoneUl').addClass('dpn');
            _this.removeClass('fa-minus-circle').addClass('fa-plus-circle s_fc_brand');
            _this.attr('data-value', '2');
            checkSh()
        } else {
            // 否则展开
            _this.parent('div').parent('div').siblings('.hideAdzoneUl').removeClass('dpn');
            _this.addClass('fa-minus-circle').removeClass('fa-plus-circle s_fc_brand');
            _this.attr('data-value', '1');
            checkSh()
        }
    });

    // 点击全部收起、展开
    $('.all-expanded-or-closed').click(function () {
        var _this = $(this);
        if (_this.html() == '全部展开') {
            _this.html('全部收起');
            $('.hideAdzone').attr('data-value', '1');
            $('.hideAdzone').removeClass('fa-plus-circle s_fc_brand').addClass('fa-minus-circle');
            $('.hideAdzoneUl').removeClass('dpn');
        } else {
            _this.html('全部展开');
            $('.hideAdzone').attr('data-value', '2');
            $('.hideAdzone').removeClass('fa-minus-circle').addClass('fa-plus-circle s_fc_brand');
            $('.hideAdzoneUl').addClass('dpn');
        }
    });

    // head头批量出价(input 时时监听 input porpertychange)
    $('.set-price-div').on('input porpertychange', '.batch-offer-input-head', function () {
        var _this = $(this);
        var value = _this.val();
        _this.parent('div').parent('div').parent('div').parent('div').next('div').find('.batch-offer-input').val(value);
    });

    // 上一步
    $('.plan-last-step').click(function () {
        $('.nav-tabs li').eq(1).removeClass('active').siblings('li').addClass('disabled');
        $('.nav-tabs li').eq(0).addClass('active');
        $('.tab-pane').eq(1).removeClass('active in');
        $('.tab-pane').eq(0).addClass('active in');
    });

    // 下一步提交数据
    $('.create-unit').click(function () {

        var crowds = '', dataUrl, adzoneBidList = new Array(), intelligentBid, i = 0, groupName, tt = '',
            dmpCrowdId = new Array(), adzoneBidListStr = '';
        $('.set-price-div .bid-div').each(function () {
            var crowdType = $('.damo-disk-orientation').attr('data-crowdType');
            var _this = $(this);
            var crowdValue = _this.children('div').attr('data-value');
            var crowdName = _this.children('div').children('div').find('span').html();
            crowds += '{"crowdType": ' + crowdType + ',"crowdName":"' + crowdName + '","crowdValue": ' + crowdValue + ', "matrixPrice": [';

            var indexC = $.inArray(crowdValue, dmpCrowdId);
            if (indexC < 0) {
                dmpCrowdId.push(crowdValue);
            }

            $(_this).children('div').next('div').find('ul li').each(function () {
                var _Lthis = $(this);
                var adzoneid = _Lthis.attr('data-adzoneid');
                var price = _Lthis.find('input').val();
                if (price == '') {
                    i = i + 1;
                }

                crowds += '{"adzoneId": ' + adzoneid + ', "price": ' + price + '},';

                var index = $.inArray(adzoneid, adzoneBidList);
                if (index < 0) {
                    adzoneBidList.push(adzoneid);
                    adzoneBidListStr += '{"adzoneId":' + adzoneid + '},';
                }
            });

            crowds = crowds.substring(0, crowds.length - 1);

            crowds += ']},';
        });

        adzoneBidListStr = adzoneBidListStr.substring(0, adzoneBidListStr.length - 1);

        if (i > 0) {
            LAYER_MSG('请设置出价');
            return false;
        }

        // 删除最后一个,
        crowds = crowds.substring(0, crowds.length - 1);
        dataUrl = $(this).attr('data-url');
        intelligentBid = $('input[name="intelligentBid"]:checked').val();
        groupName = $('input[name="adgroup_name"]').val();

        $.ajax({
            url: dataUrl,
            type: 'get',
            data: {
                'crowds': crowds,
                'adzoneBidListStr': adzoneBidListStr,
                'adzone_bid_list': adzoneBidList.join(','),
                'intelligent_bid': intelligentBid,
                'group_name': groupName,
                'dmpCrowdIds': dmpCrowdId.join(','),
            },
            success: function (response) {
                if (response.result == true) {
                    LAYER_MSG_('提交成功', 1);

                    $('.nav-tabs li').eq(1).removeClass('active').siblings('li').addClass('disabled');
                    $('.nav-tabs li').eq(2).addClass('active');
                    $('.tab-pane').removeClass('active in');
                    $('.tab-pane').eq(2).addClass('active in');
                } else {
                    LAYER_MSG_('服务器错误', 2);
                }
            },
            error: function (e, jqxhr, settings, exception) {
                LAYER_MSG_('加载失败', 2);
            }
        });

    });

    // 判断是否出价 head头
    $('.set-price-div').on('input porpertychange', '.batch-offer-input-head', function () {
        var _this, value, reg;
        _this = $(this);
        value = _this.val();

        reg = /^[1-9]\d+(\.\d{1,2})?$/;
        if (reg.test(value)) {
            _this.parent('div').siblings().eq(1).hide();
        } else {
            _this.parent('div').siblings().eq(1).show().css('color', 'red');
            $('input[name="price"]').val('');
        }
    });

    // 判断是否出价 单个
    $('.set-price-div').on('input porpertychange', 'input[name="price"]', function () {
        var _this, value, reg;
        _this = $(this);
        value = _this.val();
        if (value == null || value == undefined || value == '') {
            _this.parent('div').siblings().eq(1).show().css('color', 'red');
        } else {
            _this.parent('div').siblings().eq(1).hide();
        }

        reg = /^[1-9]\d+(\.\d{1,2})?$/;
        if (reg.test(value)) {
            _this.parent('div').siblings().eq(2).hide();
        } else {
            _this.parent('div').siblings().eq(2).show().css('color', 'red');
        }
    });

    // 获取session 保存的数据 TODO (还有一点问题就是出价没保存)  还有一点是弹出框没有选中
    getSessionSetUnit();

    function getSessionSetUnit() {
        var dataUrl = $('input[name="SessionSetUnit"]').val();
        $.ajax({
            url: dataUrl,
            type: 'get',
            data: {},
            success: function (response) {

                if (response.result == true) {

                    var data, dmpHtml = '', adzoneHtml = '', dmpArrayLength = 0, adzoneArrayLength = 0, intelligentBid;
                    data = response.data;

                    $('input[name="adgroup_name"]').val(data.group_name);

                    dmpArrayLength = data.dmpCrowds.length;
                    adzoneArrayLength = data.adzoneBidList.length;
                    if (dmpArrayLength > 0) {
                        $.each(data.dmpCrowds, function (i, v) {
                            dmpHtml += '<div class="target-choose-result-item"><span>' + v.dmp_crowd_name + '</span><a class="delete" href="javascript:;" data-value="' + v.dmp_crowd_id + '"><i class="fa fa-times"></i></a></div>';
                        });
                        $('#target_premium_128').removeClass('dpn');
                        $('#target_premium_128').children("div:first-child").html(dmpHtml);
                    }

                    if (adzoneArrayLength > 0) {
                        $.each(data.adzoneBidList, function (i, v) {
                            adzoneHtml += '<tr><th><input value="' + v.adzone_id + '" type="checkbox" class="resources-checkbox" checked=""></th><td>' + v.adzone_name + '</td><td>--</td><td>--</td><td>--</td><td>--</td><td><span class="text-overflow adzoneSizeListTd">' + v.adzone_size_list + '</span></td><td><span class="btn btn-gray resource-del">移除</span></td></tr>';
                        });
                        $('.no-resource-selected-div').addClass('dpn');
                        $('.resource-list-div').removeClass('dpn');
                        $('.resource-list-table-tr').append(adzoneHtml);
                    }

                    intelligentBid = data.intelligent_bid;
                    $('input[name="intelligentBid"]').each(function () {
                        var _this = $(this), valut = _this.val();
                        if (intelligentBid == valut) {
                            _this.attr('checked', 'checked');
                        }
                    });

                    setPriceShowOrHide();
                } else {
                    console.log('服务器错误');
                }

            },
            error: function (e, jqxhr, settings, exception) {
                console.log('加载失败');
            }
        });
    }
});