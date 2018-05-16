// 计划 js
$(function () {

    $("[data-toggle='tab']").tooltip(); // 工具提示（Tooltip）插件 - 锚


    // 地域设置 显示隐藏
    $('.region').click(function () {

        var regionVal = $(this).val();
        if (regionVal == 1) {
            $('.region-select').css('display', 'block')
        } else {
            $('.region-select').css('display', 'none')
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
        console.log(url);
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
                if (res.result = true) {

                    // ajax 更新列表

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

    // 时段设置 显示隐藏
    $('.period-type').click(function () {

        var periodTypeVal = $(this).val();
        if (periodTypeVal == 1) {
            $('.period-type-select').css('display', 'block')
        } else {
            $('.period-type-select').css('display', 'none')
        }
    });

    // 选中时间
    $('.periodWrapper .period ul li').click(function () {

        KISSY.add("app/views/main/plan/period", function (n, e, a) {
            return e.extend({
                template: '<div class="periodWrapper">\n    <div class="period">\n        <ul class="hours clearfix mb40">\n            <li class="all" data-spm-click="gostr=/alimama.5;locaid=d510ab51d">\n                <span class="btnInfo">\u65f6\u95f4\u6bb5</span>\n                <a href="javascript:;" mx-click="toggleAll" data-spm-click="gostr=/alimama.5;locaid=d8d499c8b" class="allBtn">\u5468\u4e00\u81f3\u5468\u4e94</a>\n            </li>\n            {{#hours}}\n            <li mx-mousedown="drag" data-spm-click="gostr=/alimama.5;locaid=dfa07eafe" class="one hour {{#milestone}}milestone{{/milestone}}" value="{{index}}">\n                <div class="hourInner">\n                    <span class="hourInnerTop"></span>\n                </div>\n                <div class="curLineStart" style="z-index: {{zIndex}}">\n                    <span class="lineArrow"></span>\n                    <span class="lineInfo">{{index}}</span>\n                </div>\n                <div class="curLineEnd" style="z-index: {{zIndex}}">\n                    <span class="lineArrow"></span>\n                    <span class="lineInfo">{{indexNext}}</span>\n                </div>\n                <div class="hourLine">\n                    <span class="hourInfo">{{index}}</span>\n                </div>\n            </li>\n            {{/hours}}\n            <li class="hour milestone hourLast">\n                <span class="hourLine">\n                    <span class="hourInfo">24</span>\n                </span>\n            </li>\n        </ul>\n\n        <ul class="hours clearfix mb10">\n            <li class="all" data-spm-click="gostr=/alimama.5;locaid=d8f219ba4">\n                <span class="btnInfo">\u65f6\u95f4\u6bb5</span>\n                <a href="javascript:;" mx-click="toggleAll" data-spm-click="gostr=/alimama.5;locaid=d397fd007" class="allBtn">\u5468\u516d\u81f3\u5468\u65e5</a>\n            </li>\n            {{#hours}}\n            <li mx-mousedown="drag" data-spm-click="gostr=/alimama.5;locaid=dd2f3a0b3" class="one hour {{#milestone}}milestone{{/milestone}}" value="{{index}}">\n                <div class="hourInner">\n                    <span class="hourInnerTop"></span>\n                </div>\n                <div class="curLineStart" style="z-index: {{zIndex}}">\n                    <span class="lineArrow"></span>\n                    <span class="lineInfo">{{index}}</span>\n                </div>\n                <div class="curLineEnd" style="z-index: {{zIndex}}">\n                    <span class="lineArrow"></span>\n                    <span class="lineInfo">{{indexNext}}</span>\n                </div>\n                <div class="hourLine">\n                    <span class="hourInfo">{{index}}</span>\n                </div>\n            </li>\n            {{/hours}}\n            <li class="hour milestone hourLast">\n                <span class="hourLine">\n                    <span class="hourInfo">24</span>\n                </span>\n            </li>\n        </ul>\n    </div>\n    <div class="clearfix s_fc_9" style="margin-right: 2%; margin-left: 1%;">\n        <a mx-click="clearAll" data-spm-click="gostr=/alimama.5;locaid=d82658961" href="javascript:;" class="btn mr10 fl"><i class="zs_iconfont displacement-2 mr5">&#xe72e;</i>\u6e05\u7a7a</a>\n        <vframe id="vf_period_template_add"></vframe>\n        <span class="fr">\u84dd\u8272\u4e3a\u5df2\u9009\u6295\u653e\u65f6\u6bb5</span>\n    </div>\n</div>',
                init: function (n) {
                    var e = JSON.parse(n), a = this;
                    a.timeTargetMap = a.toMap(e, {}), a.data = {
                        hours: function (n) {
                            for (var e = 0; e < 24; e++) n.push({
                                index: e,
                                indexNext: e + 1,
                                milestone: e % 6 == 0,
                                zIndex: e + 10
                            });
                            return n
                        }([])
                    }
                },
                toMap: function (n, e) {
                    return a.each(n, function (n) {
                        e[n.dayOfWeek] = n.timeSpanList
                    }), e
                },
                render: function () {
                    var n = this;
                    n.setViewPagelet(n.data, function (e) {
                        n.fixStyle()
                    })
                },
                fixStyle: function () {
                    function n(n, s) {
                        var l = $("#" + e.id + " .period ul.hours").item(n);
                        a.each(l.all("li.one"), function (n) {
                            var l = $(n).attr("value");
                            a.indexOf(e.timeTargetMap[s], +l) < 0 ? $(n).removeClass("selected") : $(n).addClass("selected")
                        }), e._merge(l), e.syncAllStatus(l.all("li.all"), l.all("li.one"))
                    }

                    var e = this;
                    n(0, "0111110"), n(1, "1000001")
                },
                "toggleAll<click>": function (n) {
                    var e = $("#" + n.currentId).parent(".all");
                    e.toggleClass("allselected"), e.siblings(".one")[e.hasClass("allselected") ? "addClass" : "removeClass"]("selected"), this._merge(e.parent("ul.hours"))
                },
                "clearAll<click>": function () {
                    var n = this, e = $("#" + n.id + " .allBtn");
                    a.each(e, function (e) {
                        var a = $(e).parent(".all");
                        a.removeClass("allselected"), a.siblings(".one").removeClass("selected"), n._merge(a.parent("ul.hours"))
                    })
                },
                "drag<mousedown>": function (n) {
                    var e = this, a = $("#" + n.currentId), s = !a.hasClass("selected");
                    a.toggleClass("selected");
                    var l = a.parent("ul.hours");
                    e._merge(l);
                    var i = a.siblings(".all"), t = i.siblings(".one");
                    return e.syncAllStatus(i, t), t.on("mouseenter.drag", function (n) {
                        n.preventDefault(), $(this)[s ? "addClass" : "removeClass"]("selected"), e._merge(l), e.syncAllStatus(i, t)
                    }), $(document.body).detach("mouseup.drag").on("mouseup.drag", function (n) {
                        t.detach("mouseenter.drag")
                    }), n.srcEvent.preventDefault(), !1
                },
                _merge: function (n) {
                    var e = $(n).all(".one");
                    a.each(e, function (n, e) {
                        n = $(n);
                        var a = n.find(".curLineStart"), s = n.find(".curLineEnd");
                        n.hasClass("selected") ? (a[n.prev(".one") && n.prev(".one").hasClass("selected") ? "hide" : "show"](), s[n.next(".one") && n.next(".one").hasClass("selected") ? "hide" : "show"]()) : (a.hide(), s.hide())
                    })
                },
                syncAllStatus: function (n, e) {
                    n[24 === e.filter(".selected").length ? "addClass" : "removeClass"]("allselected")
                },
                getSelected: function () {
                    function n(n) {
                        var s = [];
                        return a.each($("#" + e.id + " .period ul.hours").item(n).all("li.one.selected"), function (n) {
                            s.push(+$(n).attr("value"))
                        }), s
                    }

                    var e = this;
                    return [{dayOfWeek: "0111110", timeSpanList: n(0)}, {dayOfWeek: "1000001", timeSpanList: n(1)}]
                },
                update: function (n) {
                    var e = JSON.parse(n);
                    this.timeTargetMap = this.toMap(e, {}), this.fixStyle()
                },
                doDataBeforeSubmit: function () {
                    for (var n = this, e = n.getSelected(), s = !1, l = 0; l < e.length; l++) s = s || !a.isEmpty(e[l].timeSpanList);
                    return s ? {ok: !0, params: {templateValue: JSON.stringify(e)}} : {
                        ok: !1,
                        msg: "\u8bf7\u81f3\u5c11\u9009\u62e9\u4e00\u4e2a\u65f6\u6bb5"
                    }
                }
            })
        }, {requires: ["mxext/view", "components/underscore/", "app/views/main/assets/period.css"]});

    });

    // ajax 提交 计划设置
    $('.create-plan').click(function () {

        if ($('#taobao_shop_name').val() == '' || $('.taobao_user_id').val() == '') {
            LAYER_MSG('请正确选择店铺');
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