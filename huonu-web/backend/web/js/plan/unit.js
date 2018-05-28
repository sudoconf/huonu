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
                            '<th><input class="bx-anim-radio" type="radio" name="similar-radios" value="' + v.item_id + '"></th>' +
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
                            '<th><input type="checkbox" value="' + v.dmp_crowd_id + '"></th>' +
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
    function getClassOrientationAdvancedInterestPoint() {
        var dataUrl = $('.class-orientation-advanced-interest-point').attr('data-url');
        $.ajax({
            url: dataUrl,
            type: 'get',
            data: {},
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

    // 当模态框完全对用户隐藏时触发
    $('#classOrientationAdvancedInterestPoint').on('hidden.bs.modal', function () {
        getClassOrientationAdvancedInterestPoint();
        $('.class-orientation-advanced-interest-point-ul-r').html('');
    });
    // 在调用 show 方法后触发
    $('#classOrientationAdvancedInterestPoint').on('show.bs.modal', function () {
        getClassOrientationAdvancedInterestPoint();
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
    getResources();
    function getResources() {
        var dataUrl = $('.resource-list').attr('data-resources-url');
        $.ajax({
            url: dataUrl,
            type: 'get',
            data: {},
            success: function (response) {
                if (response.result == true) {
                    var data = response.data;
                    var htmlStr = '';

                    console.log(data);return false

                    // $('.resource-list-tr').html(htmlStr);
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