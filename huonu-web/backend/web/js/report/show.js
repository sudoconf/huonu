$(function () {

    // var multitrayId = $('#multitrayId').val();
    // $.ajax({
    //     url: 'ajax-get-statistic-data.html',
    //     type: 'get',
    //     data: {'multitrayId': multitrayId},
    //     dataType: 'json',
    //     beforeSend: function () {
    //         i = SHOW_LOAD_LAYER();
    //     },
    //     success: function (response) {
    //         CLOSE_LOAD_LAYER(i);
    //
    //         if (response.result == "true") {
    //
    //             var jsonData = $.parseJSON(response.data.multitray_statistics_content_json);
    //             var legendArray = []; // 头部筛选按钮
    //             var xAxis = []; // x 横坐标 时间节点
    //             var series = []; // y 轴坐标节点
    //             $.each(jsonData, function (i, val) {
    //                 legendArray.push(i);
    //                 $.each(val, function (t, tv) {
    //                     if ($.inArray(t, xAxis) == -1) {
    //                         xAxis.push(t);
    //                     }
    //                 });
    //             });
    //
    //             var b = '{';
    //             for (i in jsonData) {
    //                 b += '"' + i + '"' + ':[';
    //                 for (x in jsonData[i]) {
    //                     b += JSON.parse(jsonData[i][x])[0] + ','
    //                 }
    //                 b = b.substring(0, b.length - 1)
    //                 b += "],";
    //             }
    //             b = b.substring(0, b.length - 1)
    //             b += "}"
    //
    //             $.each(JSON.parse(b), function (i, val) {
    //                 series.push({
    //                     name: i,
    //                     type: 'line',
    //                     smooth: true, // 平滑
    //                     symbolSize: 0, // 图表的点的大小
    //                     data: $.each(val, function (t, va) {
    //                         return val[t]
    //                     })
    //                 })
    //             });
    //
    //             // 复盘展示
    //             var analyseChart = echarts.init(document.getElementById('analyse'));
    //             var analyseOption = {
    //                 title: {
    //                     text: '复盘效果展示图',
    //                     subtext: '效果图'
    //                 },
    //                 tooltip: {
    //                     trigger: 'axis'
    //                 },
    //                 legend: {
    //                     data: legendArray
    //                 },
    //                 toolbox: {
    //                     show: true,
    //                     feature: {
    //                         mark: {show: true},
    //                         dataView: {show: true, readOnly: false},
    //                         magicType: {show: true, type: ['line', 'bar']},
    //                         restore: {show: true},
    //                         saveAsImage: {show: true}
    //                     }
    //                 },
    //                 calculable: true,
    //                 xAxis: [
    //                     {
    //                         type: 'category',
    //                         boundaryGap: false,
    //                         data: xAxis.map(function (item) {
    //                             return item;
    //                         })
    //                     }
    //                 ],
    //                 yAxis: [
    //                     {
    //                         type: 'value',
    //                         axisLabel: {
    //                             formatter: '{value}'
    //                         }
    //                     }
    //                 ],
    //                 series: series
    //             };
    //             // 使用制定的配置项和数据显示图表
    //             analyseChart.setOption(analyseOption);
    //
    //             // 复盘消耗比
    //             var chargeSeries = [];
    //             var chargeData = []
    //             $.each($.parseJSON(response.data.charge), function (i, val) {
    //                 chargeSeries.push({value: val, name: i});
    //                 chargeData.push(val);
    //             });
    //             var consumptionChart = echarts.init(document.getElementById('consumption'));
    //             var consumptionOption = {
    //                 title: {
    //                     text: '复盘消耗占比',
    //                     subtext: '效果图',
    //                     x: 'center'
    //                 },
    //                 tooltip: {
    //                     trigger: 'item',
    //                     formatter: "{a} <br/>{b} : {c} ({d}%)"
    //                 },
    //                 legend: {
    //                     orient: 'vertical',
    //                     x: 'left',
    //                     data: legendArray
    //                 },
    //                 toolbox: {
    //                     show: true,
    //                     feature: {
    //                         mark: {show: true},
    //                         dataView: {show: true, readOnly: false},
    //                         magicType: {
    //                             show: true,
    //                             type: ['pie', 'funnel'],
    //                             option: {
    //                                 funnel: {
    //                                     x: '25%',
    //                                     width: '50%',
    //                                     funnelAlign: 'left',
    //                                     max: 1548
    //                                 }
    //                             }
    //                         },
    //                         restore: {show: true},
    //                         saveAsImage: {show: true}
    //                     }
    //                 },
    //                 calculable: true,
    //                 series: [
    //                     {
    //                         name: '访问来源',
    //                         type: 'pie',
    //                         radius: '55%',
    //                         center: ['50%', '60%'],
    //                         data: chargeSeries
    //                     }
    //                 ]
    //             };
    //             consumptionChart.setOption(consumptionOption);
    //
    //             // 投入产出比
    //             var roiData = [];
    //             var alipayInshopAmtData = [];
    //             $.each($.parseJSON(response.data.alipay_inshop_amt), function (i, val) {
    //                 alipayInshopAmtData.push(val);
    //             });
    //             $.each($.parseJSON(response.data.roi), function (i, val) {
    //                 var roiValue = new Number(val);
    //                 roiData.push(roiValue.toFixed(2));
    //             });
    //             var inputOutputChart = echarts.init(document.getElementById('inputOutput'));
    //             var inputOutputOption = {
    //                 title: {
    //                     text: '投入产出比',
    //                     subtext: '效果图'
    //                 },
    //                 tooltip: {
    //                     trigger: 'axis'
    //                 },
    //                 legend: {
    //                     data: ['消耗金额', '成交金额', 'ROI'],
    //                 },
    //                 toolbox: {
    //                     show: true,
    //                     feature: {
    //                         mark: {show: true},
    //                         dataView: {show: true, readOnly: false},
    //                         magicType: {show: true, type: ['line', 'bar']},
    //                         restore: {show: true},
    //                         saveAsImage: {show: true}
    //                     }
    //                 },
    //                 xAxis: [
    //                     {
    //                         type: 'category',
    //                         data: legendArray
    //                     }
    //                 ],
    //                 yAxis: [
    //                     {
    //                         type: 'value',
    //                         name: '消耗金额',
    //                         axisLabel: {
    //                             formatter: '{value}'
    //                         },
    //                         position: 'left',
    //                     },
    //                     {
    //                         type: 'value',
    //                         name: '成交金额',
    //                         axisLabel: {
    //                             formatter: '{value}'
    //                         },
    //                         position: 'right',
    //                     },
    //                     {
    //                         type: 'value',
    //                         name: 'ROI',
    //                         axisLabel: {
    //                             formatter: '{value}'
    //                         },
    //                         offset: 80,
    //                         position: 'right',
    //                         splitLine: {
    //                             show: false
    //                         }
    //                     }
    //                 ],
    //                 series: [
    //                     {
    //                         name: '消耗金额',
    //                         type: 'bar',
    //                         data: chargeData
    //                     },
    //                     {
    //                         name: '成交金额',
    //                         type: 'bar',
    //                         yAxisIndex: 0,
    //                         data: alipayInshopAmtData
    //                     },
    //                     {
    //                         name: 'ROI',
    //                         type: 'line',
    //                         yAxisIndex: 1,
    //                         data: roiData
    //                     }
    //                 ]
    //             };
    //             inputOutputChart.setOption(inputOutputOption);
    //
    //             // 宝贝收藏加购比
    //             var commodityCollectionRateData = [];
    //             var purchaseRateData = [];
    //             var purchaseCostGoodsCollectionData = [];
    //             $.each($.parseJSON(response.data.commodity_collection_rate), function (i, val) {
    //                 var commodityCollectionRateValue = new Number(val);
    //                 commodityCollectionRateData.push(commodityCollectionRateValue.toFixed(2));
    //             });
    //             $.each($.parseJSON(response.data.purchase_rate), function (i, val) {
    //                 var purchaseRateValue = new Number(val);
    //                 purchaseRateData.push(purchaseRateValue.toFixed(2));
    //             });
    //             $.each($.parseJSON(response.data.purchase_cost_of_goods_collection), function (i, val) {
    //                 var purchaseCostGoodsCollectionValue = new Number(val);
    //                 purchaseCostGoodsCollectionData.push(purchaseCostGoodsCollectionValue.toFixed(2));
    //             });
    //             var treasureCollectionPurchaseChart = echarts.init(document.getElementById('treasureCollectionPurchase'));
    //             var treasureCollectionPurchaseOption = {
    //                 title: {
    //                     text: '宝贝收藏加购比',
    //                     subtext: '效果图'
    //                 },
    //                 tooltip: {
    //                     trigger: 'axis'
    //                 },
    //                 legend: {
    //                     data: ['商品收藏率', '商品加购率', '商品收藏加购成本'],
    //                 },
    //                 toolbox: {
    //                     show: true,
    //                     feature: {
    //                         mark: {show: true},
    //                         dataView: {show: true, readOnly: false},
    //                         magicType: {show: true, type: ['line', 'bar']},
    //                         restore: {show: true},
    //                         saveAsImage: {show: true}
    //                     }
    //                 },
    //                 xAxis: [
    //                     {
    //                         type: 'category',
    //                         data: legendArray
    //                     }
    //                 ],
    //                 yAxis: [
    //                     {
    //                         type: 'value',
    //                         name: '商品收藏率',
    //                         axisLabel: {
    //                             formatter: '{value}'
    //                         },
    //                         position: 'left',
    //                     },
    //                     {
    //                         type: 'value',
    //                         name: '商品加购率',
    //                         axisLabel: {
    //                             formatter: '{value}'
    //                         },
    //                         position: 'right',
    //                     },
    //                     {
    //                         type: 'value',
    //                         name: '商品收藏加购成本',
    //                         axisLabel: {
    //                             formatter: '{value}'
    //                         },
    //                         offset: 80,
    //                         position: 'right',
    //                         splitLine: {
    //                             show: false
    //                         }
    //                     }
    //                 ],
    //                 series: [
    //                     {
    //                         name: '商品收藏率',
    //                         type: 'bar',
    //                         data: commodityCollectionRateData
    //                     },
    //                     {
    //                         name: '商品加购率',
    //                         type: 'bar',
    //                         yAxisIndex: 0,
    //                         data: purchaseRateData
    //                     },
    //                     {
    //                         name: '商品收藏加购成本',
    //                         type: 'line',
    //                         yAxisIndex: 1,
    //                         data: purchaseCostGoodsCollectionData
    //                     }
    //                 ]
    //             };
    //             treasureCollectionPurchaseChart.setOption(treasureCollectionPurchaseOption);
    //
    //         } else {
    //             LAYER_MSG('加载失败！', i);
    //         }
    //
    //     },
    //     error: function (e, jqxhr, settings, exception) {
    //         LAYER_MSG('加载失败！', i);
    //     }
    // });
    //
    // $('.field').click(function () {
    //     var fieldVal = $(this).children('a').html();
    //     var fieldHtml = fieldVal + " <span class='caret'></span>";
    //     $('#field-select .btn-group button[type="button"]').html(fieldHtml);
    //
    //     var field = $(this).children('a').attr('data-value');
    //
    //     var fieldArray = ['charge', 'ad_pv', 'click', 'uv', 'deep_inshop_uv', 'avg_access_time', 'avg_access_page_num', 'inshop_item_col_num', 'dir_shop_col_num', 'cart_num', 'purchase_rate_of_goods', 'commodity_collection_rate', 'commodity_collection_cost', 'purchase_cost_of_goods', 'purchase_cost_of_goods_collection', 'gmv_inshop_num', 'gmv_inshop_amt', 'alipay_in_shop_num', 'alipay_inshop_amt', 'average_cost_of_order', 'order_average_amount', 'roi', 'ecpm', 'ctr', 'ecpc', 'cvr'];
    //
    //     var fieldI = 0;
    //     $.each(fieldArray, function (fi, fv) {
    //         if (fv == field) {
    //             fieldI = fi;
    //             return false; // 跳出循环
    //         }
    //     });
    //
    //     $.ajax({
    //         url: 'ajax-get-statistic-data.html',
    //         type: 'get',
    //         data: {'multitrayId': multitrayId},
    //         dataType: 'json',
    //         beforeSend: function () {
    //             i = SHOW_LOAD_LAYER();
    //         },
    //         success: function (response) {
    //             CLOSE_LOAD_LAYER(i);
    //
    //             if (response.result == "true") {
    //
    //                 var jsonData = $.parseJSON(response.data.multitray_statistics_content_json);
    //                 var legendArray = []; // 头部筛选按钮
    //                 var xAxis = []; // x 横坐标 时间节点
    //                 var series = []; // y 轴坐标节点
    //                 $.each(jsonData, function (i, val) {
    //                     legendArray.push(i);
    //                     $.each(val, function (t, tv) {
    //                         if ($.inArray(t, xAxis) == -1) {
    //                             xAxis.push(t);
    //                         }
    //                     });
    //                 });
    //
    //                 var b = '{';
    //                 for (i in jsonData) {
    //                     b += '"' + i + '"' + ':[';
    //                     for (x in jsonData[i]) {
    //                         b += JSON.parse(jsonData[i][x])[fieldI] + ','
    //                     }
    //                     b = b.substring(0, b.length - 1)
    //                     b += "],";
    //                 }
    //                 b = b.substring(0, b.length - 1)
    //                 b += "}"
    //
    //                 $.each(JSON.parse(b), function (i, val) {
    //                     series.push({
    //                         name: i,
    //                         type: 'line',
    //                         smooth: true, // 平滑
    //                         symbolSize: 0, // 图表的点的大小
    //                         data: $.each(val, function (t, va) {
    //                             return val[t]
    //                         })
    //                     })
    //                 });
    //
    //                 // 复盘展示
    //                 var analyseChart = echarts.init(document.getElementById('analyse'));
    //                 var analyseOption = {
    //                     title: {
    //                         text: '复盘效果展示图',
    //                         subtext: '效果图'
    //                     },
    //                     tooltip: {
    //                         trigger: 'axis'
    //                     },
    //                     legend: {
    //                         data: legendArray
    //                     },
    //                     toolbox: {
    //                         show: true,
    //                         feature: {
    //                             mark: {show: true},
    //                             dataView: {show: true, readOnly: false},
    //                             magicType: {show: true, type: ['line', 'bar']},
    //                             restore: {show: true},
    //                             saveAsImage: {show: true}
    //                         }
    //                     },
    //                     calculable: true,
    //                     xAxis: [
    //                         {
    //                             type: 'category',
    //                             boundaryGap: false,
    //                             data: xAxis.map(function (item) {
    //                                 return item;
    //                             })
    //                         }
    //                     ],
    //                     yAxis: [
    //                         {
    //                             type: 'value',
    //                             axisLabel: {
    //                                 formatter: '{value}'
    //                             }
    //                         }
    //                     ],
    //                     series: series
    //                 };
    //                 // 使用制定的配置项和数据显示图表
    //                 analyseChart.setOption(analyseOption);
    //
    //                 // 复盘消耗比
    //                 var chargeSeries = [];
    //                 var chargeData = []
    //                 $.each($.parseJSON(response.data.charge), function (i, val) {
    //                     chargeSeries.push({value: val, name: i});
    //                     chargeData.push(val);
    //                 });
    //                 var consumptionChart = echarts.init(document.getElementById('consumption'));
    //                 var consumptionOption = {
    //                     title: {
    //                         text: '复盘消耗占比',
    //                         subtext: '效果图',
    //                         x: 'center'
    //                     },
    //                     tooltip: {
    //                         trigger: 'item',
    //                         formatter: "{a} <br/>{b} : {c} ({d}%)"
    //                     },
    //                     legend: {
    //                         orient: 'vertical',
    //                         x: 'left',
    //                         data: legendArray
    //                     },
    //                     toolbox: {
    //                         show: true,
    //                         feature: {
    //                             mark: {show: true},
    //                             dataView: {show: true, readOnly: false},
    //                             magicType: {
    //                                 show: true,
    //                                 type: ['pie', 'funnel'],
    //                                 option: {
    //                                     funnel: {
    //                                         x: '25%',
    //                                         width: '50%',
    //                                         funnelAlign: 'left',
    //                                         max: 1548
    //                                     }
    //                                 }
    //                             },
    //                             restore: {show: true},
    //                             saveAsImage: {show: true}
    //                         }
    //                     },
    //                     calculable: true,
    //                     series: [
    //                         {
    //                             name: '访问来源',
    //                             type: 'pie',
    //                             radius: '55%',
    //                             center: ['50%', '60%'],
    //                             data: chargeSeries
    //                         }
    //                     ]
    //                 };
    //                 consumptionChart.setOption(consumptionOption);
    //
    //                 // 投入产出比
    //                 var roiData = [];
    //                 var alipayInshopAmtData = [];
    //                 $.each($.parseJSON(response.data.alipay_inshop_amt), function (i, val) {
    //                     alipayInshopAmtData.push(val);
    //                 });
    //                 $.each($.parseJSON(response.data.roi), function (i, val) {
    //                     var roiValue = new Number(val);
    //                     roiData.push(roiValue.toFixed(2));
    //                 });
    //                 var inputOutputChart = echarts.init(document.getElementById('inputOutput'));
    //                 var inputOutputOption = {
    //                     title: {
    //                         text: '投入产出比',
    //                         subtext: '效果图'
    //                     },
    //                     tooltip: {
    //                         trigger: 'axis'
    //                     },
    //                     legend: {
    //                         data: ['消耗金额', '成交金额', 'ROI'],
    //                     },
    //                     toolbox: {
    //                         show: true,
    //                         feature: {
    //                             mark: {show: true},
    //                             dataView: {show: true, readOnly: false},
    //                             magicType: {show: true, type: ['line', 'bar']},
    //                             restore: {show: true},
    //                             saveAsImage: {show: true}
    //                         }
    //                     },
    //                     xAxis: [
    //                         {
    //                             type: 'category',
    //                             data: legendArray
    //                         }
    //                     ],
    //                     yAxis: [
    //                         {
    //                             type: 'value',
    //                             name: '消耗金额',
    //                             axisLabel: {
    //                                 formatter: '{value}'
    //                             },
    //                             position: 'left',
    //                         },
    //                         {
    //                             type: 'value',
    //                             name: '成交金额',
    //                             axisLabel: {
    //                                 formatter: '{value}'
    //                             },
    //                             position: 'right',
    //                         },
    //                         {
    //                             type: 'value',
    //                             name: 'ROI',
    //                             axisLabel: {
    //                                 formatter: '{value}'
    //                             },
    //                             offset: 80,
    //                             position: 'right',
    //                             splitLine: {
    //                                 show: false
    //                             }
    //                         }
    //                     ],
    //                     series: [
    //                         {
    //                             name: '消耗金额',
    //                             type: 'bar',
    //                             data: chargeData
    //                         },
    //                         {
    //                             name: '成交金额',
    //                             type: 'bar',
    //                             yAxisIndex: 0,
    //                             data: alipayInshopAmtData
    //                         },
    //                         {
    //                             name: 'ROI',
    //                             type: 'line',
    //                             yAxisIndex: 1,
    //                             data: roiData
    //                         }
    //                     ]
    //                 };
    //                 inputOutputChart.setOption(inputOutputOption);
    //
    //                 // 宝贝收藏加购比
    //                 var commodityCollectionRateData = [];
    //                 var purchaseRateData = [];
    //                 var purchaseCostGoodsCollectionData = [];
    //                 $.each($.parseJSON(response.data.commodity_collection_rate), function (i, val) {
    //                     var commodityCollectionRateValue = new Number(val);
    //                     commodityCollectionRateData.push(commodityCollectionRateValue.toFixed(2));
    //                 });
    //                 $.each($.parseJSON(response.data.purchase_rate), function (i, val) {
    //                     var purchaseRateValue = new Number(val);
    //                     purchaseRateData.push(purchaseRateValue.toFixed(2));
    //                 });
    //                 $.each($.parseJSON(response.data.purchase_cost_of_goods_collection), function (i, val) {
    //                     var purchaseCostGoodsCollectionValue = new Number(val);
    //                     purchaseCostGoodsCollectionData.push(purchaseCostGoodsCollectionValue.toFixed(2));
    //                 });
    //                 var treasureCollectionPurchaseChart = echarts.init(document.getElementById('treasureCollectionPurchase'));
    //                 var treasureCollectionPurchaseOption = {
    //                     title: {
    //                         text: '宝贝收藏加购比',
    //                         subtext: '效果图'
    //                     },
    //                     tooltip: {
    //                         trigger: 'axis'
    //                     },
    //                     legend: {
    //                         data: ['商品收藏率', '商品加购率', '商品收藏加购成本'],
    //                     },
    //                     toolbox: {
    //                         show: true,
    //                         feature: {
    //                             mark: {show: true},
    //                             dataView: {show: true, readOnly: false},
    //                             magicType: {show: true, type: ['line', 'bar']},
    //                             restore: {show: true},
    //                             saveAsImage: {show: true}
    //                         }
    //                     },
    //                     xAxis: [
    //                         {
    //                             type: 'category',
    //                             data: legendArray
    //                         }
    //                     ],
    //                     yAxis: [
    //                         {
    //                             type: 'value',
    //                             name: '商品收藏率',
    //                             axisLabel: {
    //                                 formatter: '{value}'
    //                             },
    //                             position: 'left',
    //                         },
    //                         {
    //                             type: 'value',
    //                             name: '商品加购率',
    //                             axisLabel: {
    //                                 formatter: '{value}'
    //                             },
    //                             position: 'right',
    //                         },
    //                         {
    //                             type: 'value',
    //                             name: '商品收藏加购成本',
    //                             axisLabel: {
    //                                 formatter: '{value}'
    //                             },
    //                             offset: 80,
    //                             position: 'right',
    //                             splitLine: {
    //                                 show: false
    //                             }
    //                         }
    //                     ],
    //                     series: [
    //                         {
    //                             name: '商品收藏率',
    //                             type: 'bar',
    //                             data: commodityCollectionRateData
    //                         },
    //                         {
    //                             name: '商品加购率',
    //                             type: 'bar',
    //                             yAxisIndex: 0,
    //                             data: purchaseRateData
    //                         },
    //                         {
    //                             name: '商品收藏加购成本',
    //                             type: 'line',
    //                             yAxisIndex: 1,
    //                             data: purchaseCostGoodsCollectionData
    //                         }
    //                     ]
    //                 };
    //                 treasureCollectionPurchaseChart.setOption(treasureCollectionPurchaseOption);
    //
    //             } else {
    //                 LAYER_MSG('加载失败！', i);
    //             }
    //
    //         },
    //         error: function (e, jqxhr, settings, exception) {
    //             LAYER_MSG('加载失败！', i);
    //         }
    //     });
    //
    // });
    //
    // // 测试例子 - 搭配时间轴
    // var myChart4 = echarts.init(document.getElementById('testChart4'));
    // var option4 = {
    //     timeline: {
    //         data: [
    //             '2002-01-01', '2003-01-01', '2004-01-01', '2005-01-01', '2006-01-01',
    //             '2007-01-01', '2008-01-01', '2009-01-01', '2010-01-01', '2011-01-01'
    //         ],
    //         label: {
    //             formatter: function (s) {
    //                 return s.slice(0, 4);
    //             }
    //         },
    //         autoPlay: true,
    //         playInterval: 1000
    //     },
    //     options: [
    //         {
    //             title: {
    //                 'text': '2002全国宏观经济指标',
    //                 'subtext': '数据来自国家统计局'
    //             },
    //             tooltip: {'trigger': 'axis'},
    //             legend: {
    //                 x: 'right',
    //                 'data': ['GDP', '金融', '房地产', '第一产业', '第二产业', '第三产业'],
    //                 'selected': {
    //                     'GDP': true,
    //                     '金融': false,
    //                     '房地产': true,
    //                     '第一产业': false,
    //                     '第二产业': false,
    //                     '第三产业': false
    //                 }
    //             },
    //             toolbox: {
    //                 'show': true,
    //                 orient: 'vertical',
    //                 x: 'right',
    //                 y: 'center',
    //                 'feature': {
    //                     'mark': {'show': true},
    //                     'dataView': {'show': true, 'readOnly': false},
    //                     'magicType': {'show': true, 'type': ['line', 'bar', 'stack', 'tiled']},
    //                     'restore': {'show': true},
    //                     'saveAsImage': {'show': true}
    //                 }
    //             },
    //             calculable: true,
    //             grid: {'y': 80, 'y2': 100},
    //             xAxis: [{
    //                 'type': 'category',
    //                 'axisLabel': {'interval': 0},
    //                 'data': [
    //                     '北京', '\n天津', '河北', '\n山西', '内蒙古', '\n辽宁', '吉林', '\n黑龙江',
    //                     '上海', '\n江苏', '浙江', '\n安徽', '福建', '\n江西', '山东', '\n河南',
    //                     '湖北', '\n湖南', '广东', '\n广西', '海南', '\n重庆', '四川', '\n贵州',
    //                     '云南', '\n西藏', '陕西', '\n甘肃', '青海', '\n宁夏', '新疆'
    //                 ]
    //             }],
    //             yAxis: [
    //                 {
    //                     'type': 'value',
    //                     'name': 'GDP（亿元）',
    //                     'max': 53500
    //                 },
    //                 {
    //                     'type': 'value',
    //                     'name': '其他（亿元）'
    //                 }
    //             ],
    //             series: [
    //                 {
    //                     'name': 'GDP',
    //                     'type': 'bar',
    //                     'markLine': {
    //                         symbol: ['arrow', 'none'],
    //                         symbolSize: [4, 2],
    //                         itemStyle: {
    //                             normal: {
    //                                 lineStyle: {color: 'orange'},
    //                                 barBorderColor: 'orange',
    //                                 label: {
    //                                     position: 'left',
    //                                     formatter: function (params) {
    //                                         return Math.round(params.value);
    //                                     },
    //                                     textStyle: {color: 'orange'}
    //                                 }
    //                             }
    //                         },
    //                         'data': [{'type': 'average', 'name': '平均值'}]
    //                     },
    //                     'data': dataMap.dataGDP['2002']
    //                 },
    //                 {
    //                     'name': '金融', 'yAxisIndex': 1, 'type': 'bar',
    //                     'data': dataMap.dataFinancial['2002']
    //                 },
    //                 {
    //                     'name': '房地产', 'yAxisIndex': 1, 'type': 'bar',
    //                     'data': dataMap.dataEstate['2002']
    //                 },
    //                 {
    //                     'name': '第一产业', 'yAxisIndex': 1, 'type': 'bar',
    //                     'data': dataMap.dataPI['2002']
    //                 },
    //                 {
    //                     'name': '第二产业', 'yAxisIndex': 1, 'type': 'bar',
    //                     'data': dataMap.dataSI['2002']
    //                 },
    //                 {
    //                     'name': '第三产业', 'yAxisIndex': 1, 'type': 'bar',
    //                     'data': dataMap.dataTI['2002']
    //                 }
    //             ]
    //         },
    //         {
    //             title: {'text': '2003全国宏观经济指标'},
    //             series: [
    //                 {'data': dataMap.dataGDP['2003']},
    //                 {'data': dataMap.dataFinancial['2003']},
    //                 {'data': dataMap.dataEstate['2003']},
    //                 {'data': dataMap.dataPI['2003']},
    //                 {'data': dataMap.dataSI['2003']},
    //                 {'data': dataMap.dataTI['2003']}
    //             ]
    //         },
    //         {
    //             title: {'text': '2004全国宏观经济指标'},
    //             series: [
    //                 {'data': dataMap.dataGDP['2004']},
    //                 {'data': dataMap.dataFinancial['2004']},
    //                 {'data': dataMap.dataEstate['2004']},
    //                 {'data': dataMap.dataPI['2004']},
    //                 {'data': dataMap.dataSI['2004']},
    //                 {'data': dataMap.dataTI['2004']}
    //             ]
    //         },
    //         {
    //             title: {'text': '2005全国宏观经济指标'},
    //             series: [
    //                 {'data': dataMap.dataGDP['2005']},
    //                 {'data': dataMap.dataFinancial['2005']},
    //                 {'data': dataMap.dataEstate['2005']},
    //                 {'data': dataMap.dataPI['2005']},
    //                 {'data': dataMap.dataSI['2005']},
    //                 {'data': dataMap.dataTI['2005']}
    //             ]
    //         },
    //         {
    //             title: {'text': '2006全国宏观经济指标'},
    //             series: [
    //                 {'data': dataMap.dataGDP['2006']},
    //                 {'data': dataMap.dataFinancial['2006']},
    //                 {'data': dataMap.dataEstate['2006']},
    //                 {'data': dataMap.dataPI['2006']},
    //                 {'data': dataMap.dataSI['2006']},
    //                 {'data': dataMap.dataTI['2006']}
    //             ]
    //         },
    //         {
    //             title: {'text': '2007全国宏观经济指标'},
    //             series: [
    //                 {'data': dataMap.dataGDP['2007']},
    //                 {'data': dataMap.dataFinancial['2007']},
    //                 {'data': dataMap.dataEstate['2007']},
    //                 {'data': dataMap.dataPI['2007']},
    //                 {'data': dataMap.dataSI['2007']},
    //                 {'data': dataMap.dataTI['2007']}
    //             ]
    //         },
    //         {
    //             title: {'text': '2008全国宏观经济指标'},
    //             series: [
    //                 {'data': dataMap.dataGDP['2008']},
    //                 {'data': dataMap.dataFinancial['2008']},
    //                 {'data': dataMap.dataEstate['2008']},
    //                 {'data': dataMap.dataPI['2008']},
    //                 {'data': dataMap.dataSI['2008']},
    //                 {'data': dataMap.dataTI['2008']}
    //             ]
    //         },
    //         {
    //             title: {'text': '2009全国宏观经济指标'},
    //             series: [
    //                 {'data': dataMap.dataGDP['2009']},
    //                 {'data': dataMap.dataFinancial['2009']},
    //                 {'data': dataMap.dataEstate['2009']},
    //                 {'data': dataMap.dataPI['2009']},
    //                 {'data': dataMap.dataSI['2009']},
    //                 {'data': dataMap.dataTI['2009']}
    //             ]
    //         },
    //         {
    //             title: {'text': '2010全国宏观经济指标'},
    //             series: [
    //                 {'data': dataMap.dataGDP['2010']},
    //                 {'data': dataMap.dataFinancial['2010']},
    //                 {'data': dataMap.dataEstate['2010']},
    //                 {'data': dataMap.dataPI['2010']},
    //                 {'data': dataMap.dataSI['2010']},
    //                 {'data': dataMap.dataTI['2010']}
    //             ]
    //         },
    //         {
    //             title: {'text': '2011全国宏观经济指标'},
    //             series: [
    //                 {'data': dataMap.dataGDP['2011']},
    //                 {'data': dataMap.dataFinancial['2011']},
    //                 {'data': dataMap.dataEstate['2011']},
    //                 {'data': dataMap.dataPI['2011']},
    //                 {'data': dataMap.dataSI['2011']},
    //                 {'data': dataMap.dataTI['2011']}
    //             ]
    //         }
    //     ]
    // };
    // myChart4.setOption(option4);

    $("[data-toggle='tab']").tooltip(); // 工具提示（Tooltip）插件 - 锚

    $('#myTab ul li').click(function () {
        var n = $(this).index(); // 这个this是你点击的那个哦
        $(this).find('span').addClass('s_fc_green');
        $(this).siblings().find('span').removeClass('s_fc_green');
        $('.analysis-data div').eq(n).fadeIn().siblings().hide();
    });
});