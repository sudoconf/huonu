<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $reportData['multitrayName'] . ' - 复盘';
$this->params['breadcrumbs'][] = $this->title;

?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-title">
                客户报表
                <small>人群复盘详情</small>
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
                <a href="<?= Url::toRoute('index') ?>">客户报表</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">报表详情</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#"><?= $reportData['multitrayName'] ?></a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <input type="hidden" id="multitrayId" name="multitrayId" value="<?= $reportData['multitrayId'] ?>">
            <input type="hidden" id="policyGroupName" name="policyGroupName"
                   value="<?= implode(',', $reportData['policyGroupName']) ?>">
            <input type="hidden" id="charge" name="charge" value="<?= implode(',', $reportData['charge']) ?>">
            <input type="hidden" id="alipayInshopAmt" name="alipayInshopAmt"
                   value="<?= implode(',', $reportData['alipayInshopAmt']) ?>">
            <input type="hidden" id="roi" name="roi" value="<?= implode(',', $reportData['roi']) ?>">

            <input type="hidden" id="commodityCollectionRate" name="commodityCollectionRate"
                   value="<?= implode(',', $reportData['commodityCollectionRate']) ?>">
            <input type="hidden" id="purchaseRate" name="purchaseRate"
                   value="<?= implode(',', $reportData['purchaseRate']) ?>">
            <input type="hidden" id="purchaseCostGoodsCollection" name="purchaseCostGoodsCollection"
                   value="<?= implode(',', $reportData['purchaseCostGoodsCollection']) ?>">

            <div class="testChart" id="testChart" style="width: 100%; height: 600px;"></div>
            <div class="testChart1" id="testChart1" style="width: 100%; height: 600px;"></div>
            <div class="testChart2" id="testChart2" style="width: 100%; height: 600px;"></div>
            <div class="testChart3" id="testChart3" style="width: 100%; height: 600px;"></div>
            <div class="testChart4" id="testChart4" style="width: 100%; height: 600px;"></div>

        </div>
    </div>

</div>


<?= Html::jsFile('@web/vendor/echarts-2.2.7/echarts-all.js') ?>
<?= Html::jsFile('@web/js/plan/timelineOption.js') ?>

<script type="text/javascript">


    $(function () {

        // 复盘展示
        var myChart = echarts.init(document.getElementById('testChart'));

        var multitrayId = $('#multitrayId').val();
        $.ajax({
            url: 'ajax-get-statistic-data.html',
            type: 'get',
            data: {'multitrayId': multitrayId},
            dataType: 'json',
            beforeSend: function () {
                i = SHOW_LOAD_LAYER();
            },
            success: function (response) {
                CLOSE_LOAD_LAYER(i);

                if (response.result == "true") {

                    var jsonData = $.parseJSON(response.data.multitray_statistics_content_json);
                    var legendArray = []; // 头部筛选按钮
                    var xAxis = []; // 横坐标
                    var series = []; // 坐标节点
                    var tt = [];

                    $.each(jsonData, function (i, val) {

                        legendArray.push(i);
                        $.each(val, function (t, tv) {
                            if ($.inArray(t, xAxis) == -1) {
                                xAxis.push(t);
                            }

                            tt.push($.parseJSON(tv));
                        });
                    });

                    for (var i = 0; i < legendArray.length; i++) {
                        series.push({
                            name: legendArray[i],
                            type: 'line',
                            smooth: true, // 平滑
                            symbolSize: 0, // 图表的点的大小
                            data: tt.map(function (item) {
                                return item[i];
                            })
                        })
                    }
                    var option = {
                        title: {
                            text: '复盘效果展示图',
                            subtext: '效果图'
                        },
                        tooltip: {
                            trigger: 'axis'
                        },
                        legend: {
                            data: legendArray
                        },
                        toolbox: {
                            show: true,
                            feature: {
                                mark: {show: true},
                                dataView: {show: true, readOnly: false},
                                magicType: {show: true, type: ['line', 'bar']},
                                restore: {show: true},
                                saveAsImage: {show: true}
                            }
                        },
                        calculable: true,
                        xAxis: [
                            {
                                type: 'category',
                                boundaryGap: false,
                                data: xAxis.map(function (item) {
                                    return item;
                                })
                            }
                        ],
                        yAxis: [
                            {
                                type: 'value',
                                axisLabel: {
                                    formatter: '{value} 元'
                                }
                            }
                        ],
                        series: series
                    };

                    // 使用制定的配置项和数据显示图表
                    myChart.setOption(option);

                } else {
                    LAYER_MSG('加载失败！', i);
                }

            },
            error: function (e, jqxhr, settings, exception) {
                LAYER_MSG('加载失败！', i);
            }
        });

        var policyGroupName = $('#policyGroupName').val();
        policyGroupName = policyGroupName.split(',');

        var charge = $('#charge').val();
        charge = charge.split(',');
        var chargeData = [];

        var alipayInshopAmt = $("#alipayInshopAmt").val();
        alipayInshopAmt = alipayInshopAmt.split(',');
        var alipayInshopAmtData = [];

        var roi = $("#roi").val();
        roi = roi.split(',');
        var roiData = [];

        var commodityCollectionRate = $("#commodityCollectionRate").val();
        commodityCollectionRate = commodityCollectionRate.split(',');
        var commodityCollectionRateData = [];

        var purchaseRate = $("#purchaseRate").val();
        purchaseRate = purchaseRate.split(',');
        var purchaseRateData = [];

        var purchaseCostGoodsCollection = $("#purchaseCostGoodsCollection").val();
        purchaseCostGoodsCollection = purchaseCostGoodsCollection.split(',');
        var purchaseCostGoodsCollectionData = [];

        // 复盘消耗
        for (var i = 0; i < policyGroupName.length; i++) {
            var chargeValue = new Number(charge[i]);
            chargeData.push({value: chargeValue.toFixed(2), name: policyGroupName[i]});

            alipayInshopAmtData.push(alipayInshopAmt[i]);
            var roiValue = new Number(roi[i]);
            roiData.push(roiValue.toFixed(2));

            var commodityCollectionRateValue = new Number(commodityCollectionRate[i]);
            commodityCollectionRateData.push(commodityCollectionRateValue.toFixed(2));

            var purchaseRateValue = new Number(purchaseRate[i]);
            purchaseRateData.push(purchaseRateValue.toFixed(2));

            var purchaseCostGoodsCollectionValue = new Number(purchaseCostGoodsCollection[i]);
            purchaseCostGoodsCollectionData.push(purchaseCostGoodsCollectionValue.toFixed(2));
        }
        var myChart1 = echarts.init(document.getElementById('testChart1'));
        var option1 = {
            title: {
                text: '复盘消耗占比',
                subtext: '效果图',
                x: 'center'
            },
            tooltip: {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            legend: {
                orient: 'vertical',
                x: 'left',
                data: policyGroupName
            },
            toolbox: {
                show: true,
                feature: {
                    mark: {show: true},
                    dataView: {show: true, readOnly: false},
                    magicType: {
                        show: true,
                        type: ['pie', 'funnel'],
                        option: {
                            funnel: {
                                x: '25%',
                                width: '50%',
                                funnelAlign: 'left',
                                max: 1548
                            }
                        }
                    },
                    restore: {show: true},
                    saveAsImage: {show: true}
                }
            },
            calculable: true,
            series: [
                {
                    name: '访问来源',
                    type: 'pie',
                    radius: '55%',
                    center: ['50%', '60%'],
                    data: chargeData
                }
            ]
        };
        myChart1.setOption(option1);

        // 投入产出比
        var myChart2 = echarts.init(document.getElementById('testChart2'));
        var option2 = {
            title: {
                text: '投入产出比',
                subtext: '效果图'
            },
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data: ['消耗金额', '成交金额', 'ROI'],
            },
            toolbox: {
                show: true,
                feature: {
                    mark: {show: true},
                    dataView: {show: true, readOnly: false},
                    magicType: {show: true, type: ['line', 'bar']},
                    restore: {show: true},
                    saveAsImage: {show: true}
                }
            },
            xAxis: [
                {
                    type: 'category',
                    data: policyGroupName
                }
            ],
            yAxis: [
                {
                    type: 'value',
                    name: '消耗金额',
                    axisLabel: {
                        formatter: '{value}'
                    },
                    position: 'left',
                },
                {
                    type: 'value',
                    name: '成交金额',
                    axisLabel: {
                        formatter: '{value}'
                    },
                    position: 'right',
                },
                {
                    type: 'value',
                    name: 'ROI',
                    axisLabel: {
                        formatter: '{value}'
                    },
                    offset: 80,
                    position: 'right',
                    splitLine: {
                        show: false
                    }
                }
            ],
            series: [
                {
                    name: '消耗金额',
                    type: 'bar',
                    data: chargeData
                },
                {
                    name: '成交金额',
                    type: 'bar',
                    yAxisIndex: 0,
                    data: alipayInshopAmtData
                },
                {
                    name: 'ROI',
                    type: 'line',
                    yAxisIndex: 1,
                    data: roiData
                }
            ]
        };
        myChart2.setOption(option2);

        // 宝贝收藏加购比
        var myChart3 = echarts.init(document.getElementById('testChart3'));
        var option3 = {
            title: {
                text: '宝贝收藏加购比',
                subtext: '效果图'
            },
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data: ['商品收藏率', '商品加购率', '商品收藏加购成本'],
            },
            toolbox: {
                show: true,
                feature: {
                    mark: {show: true},
                    dataView: {show: true, readOnly: false},
                    magicType: {show: true, type: ['line', 'bar']},
                    restore: {show: true},
                    saveAsImage: {show: true}
                }
            },
            xAxis: [
                {
                    type: 'category',
                    data: policyGroupName
                }
            ],
            yAxis: [
                {
                    type: 'value',
                    name: '商品收藏率',
                    axisLabel: {
                        formatter: '{value}'
                    },
                    position: 'left',
                },
                {
                    type: 'value',
                    name: '商品加购率',
                    axisLabel: {
                        formatter: '{value}'
                    },
                    position: 'right',
                },
                {
                    type: 'value',
                    name: '商品收藏加购成本',
                    axisLabel: {
                        formatter: '{value}'
                    },
                    offset: 80,
                    position: 'right',
                    splitLine: {
                        show: false
                    }
                }
            ],
            series: [
                {
                    name: '商品收藏率',
                    type: 'bar',
                    data: commodityCollectionRateData
                },
                {
                    name: '商品加购率',
                    type: 'bar',
                    yAxisIndex: 0,
                    data: purchaseRateData
                },
                {
                    name: '商品收藏加购成本',
                    type: 'line',
                    yAxisIndex: 1,
                    data: purchaseCostGoodsCollectionData
                }
            ]
        };
        myChart3.setOption(option3);

        // 测试例子 - 搭配时间轴
        var myChart4 = echarts.init(document.getElementById('testChart4'));
        var option4 = {
            timeline: {
                data: [
                    '2002-01-01', '2003-01-01', '2004-01-01', '2005-01-01', '2006-01-01',
                    '2007-01-01', '2008-01-01', '2009-01-01', '2010-01-01', '2011-01-01'
                ],
                label: {
                    formatter: function (s) {
                        return s.slice(0, 4);
                    }
                },
                autoPlay: true,
                playInterval: 1000
            },
            options: [
                {
                    title: {
                        'text': '2002全国宏观经济指标',
                        'subtext': '数据来自国家统计局'
                    },
                    tooltip: {'trigger': 'axis'},
                    legend: {
                        x: 'right',
                        'data': ['GDP', '金融', '房地产', '第一产业', '第二产业', '第三产业'],
                        'selected': {
                            'GDP': true,
                            '金融': false,
                            '房地产': true,
                            '第一产业': false,
                            '第二产业': false,
                            '第三产业': false
                        }
                    },
                    toolbox: {
                        'show': true,
                        orient: 'vertical',
                        x: 'right',
                        y: 'center',
                        'feature': {
                            'mark': {'show': true},
                            'dataView': {'show': true, 'readOnly': false},
                            'magicType': {'show': true, 'type': ['line', 'bar', 'stack', 'tiled']},
                            'restore': {'show': true},
                            'saveAsImage': {'show': true}
                        }
                    },
                    calculable: true,
                    grid: {'y': 80, 'y2': 100},
                    xAxis: [{
                        'type': 'category',
                        'axisLabel': {'interval': 0},
                        'data': [
                            '北京', '\n天津', '河北', '\n山西', '内蒙古', '\n辽宁', '吉林', '\n黑龙江',
                            '上海', '\n江苏', '浙江', '\n安徽', '福建', '\n江西', '山东', '\n河南',
                            '湖北', '\n湖南', '广东', '\n广西', '海南', '\n重庆', '四川', '\n贵州',
                            '云南', '\n西藏', '陕西', '\n甘肃', '青海', '\n宁夏', '新疆'
                        ]
                    }],
                    yAxis: [
                        {
                            'type': 'value',
                            'name': 'GDP（亿元）',
                            'max': 53500
                        },
                        {
                            'type': 'value',
                            'name': '其他（亿元）'
                        }
                    ],
                    series: [
                        {
                            'name': 'GDP',
                            'type': 'bar',
                            'markLine': {
                                symbol: ['arrow', 'none'],
                                symbolSize: [4, 2],
                                itemStyle: {
                                    normal: {
                                        lineStyle: {color: 'orange'},
                                        barBorderColor: 'orange',
                                        label: {
                                            position: 'left',
                                            formatter: function (params) {
                                                return Math.round(params.value);
                                            },
                                            textStyle: {color: 'orange'}
                                        }
                                    }
                                },
                                'data': [{'type': 'average', 'name': '平均值'}]
                            },
                            'data': dataMap.dataGDP['2002']
                        },
                        {
                            'name': '金融', 'yAxisIndex': 1, 'type': 'bar',
                            'data': dataMap.dataFinancial['2002']
                        },
                        {
                            'name': '房地产', 'yAxisIndex': 1, 'type': 'bar',
                            'data': dataMap.dataEstate['2002']
                        },
                        {
                            'name': '第一产业', 'yAxisIndex': 1, 'type': 'bar',
                            'data': dataMap.dataPI['2002']
                        },
                        {
                            'name': '第二产业', 'yAxisIndex': 1, 'type': 'bar',
                            'data': dataMap.dataSI['2002']
                        },
                        {
                            'name': '第三产业', 'yAxisIndex': 1, 'type': 'bar',
                            'data': dataMap.dataTI['2002']
                        }
                    ]
                },
                {
                    title: {'text': '2003全国宏观经济指标'},
                    series: [
                        {'data': dataMap.dataGDP['2003']},
                        {'data': dataMap.dataFinancial['2003']},
                        {'data': dataMap.dataEstate['2003']},
                        {'data': dataMap.dataPI['2003']},
                        {'data': dataMap.dataSI['2003']},
                        {'data': dataMap.dataTI['2003']}
                    ]
                },
                {
                    title: {'text': '2004全国宏观经济指标'},
                    series: [
                        {'data': dataMap.dataGDP['2004']},
                        {'data': dataMap.dataFinancial['2004']},
                        {'data': dataMap.dataEstate['2004']},
                        {'data': dataMap.dataPI['2004']},
                        {'data': dataMap.dataSI['2004']},
                        {'data': dataMap.dataTI['2004']}
                    ]
                },
                {
                    title: {'text': '2005全国宏观经济指标'},
                    series: [
                        {'data': dataMap.dataGDP['2005']},
                        {'data': dataMap.dataFinancial['2005']},
                        {'data': dataMap.dataEstate['2005']},
                        {'data': dataMap.dataPI['2005']},
                        {'data': dataMap.dataSI['2005']},
                        {'data': dataMap.dataTI['2005']}
                    ]
                },
                {
                    title: {'text': '2006全国宏观经济指标'},
                    series: [
                        {'data': dataMap.dataGDP['2006']},
                        {'data': dataMap.dataFinancial['2006']},
                        {'data': dataMap.dataEstate['2006']},
                        {'data': dataMap.dataPI['2006']},
                        {'data': dataMap.dataSI['2006']},
                        {'data': dataMap.dataTI['2006']}
                    ]
                },
                {
                    title: {'text': '2007全国宏观经济指标'},
                    series: [
                        {'data': dataMap.dataGDP['2007']},
                        {'data': dataMap.dataFinancial['2007']},
                        {'data': dataMap.dataEstate['2007']},
                        {'data': dataMap.dataPI['2007']},
                        {'data': dataMap.dataSI['2007']},
                        {'data': dataMap.dataTI['2007']}
                    ]
                },
                {
                    title: {'text': '2008全国宏观经济指标'},
                    series: [
                        {'data': dataMap.dataGDP['2008']},
                        {'data': dataMap.dataFinancial['2008']},
                        {'data': dataMap.dataEstate['2008']},
                        {'data': dataMap.dataPI['2008']},
                        {'data': dataMap.dataSI['2008']},
                        {'data': dataMap.dataTI['2008']}
                    ]
                },
                {
                    title: {'text': '2009全国宏观经济指标'},
                    series: [
                        {'data': dataMap.dataGDP['2009']},
                        {'data': dataMap.dataFinancial['2009']},
                        {'data': dataMap.dataEstate['2009']},
                        {'data': dataMap.dataPI['2009']},
                        {'data': dataMap.dataSI['2009']},
                        {'data': dataMap.dataTI['2009']}
                    ]
                },
                {
                    title: {'text': '2010全国宏观经济指标'},
                    series: [
                        {'data': dataMap.dataGDP['2010']},
                        {'data': dataMap.dataFinancial['2010']},
                        {'data': dataMap.dataEstate['2010']},
                        {'data': dataMap.dataPI['2010']},
                        {'data': dataMap.dataSI['2010']},
                        {'data': dataMap.dataTI['2010']}
                    ]
                },
                {
                    title: {'text': '2011全国宏观经济指标'},
                    series: [
                        {'data': dataMap.dataGDP['2011']},
                        {'data': dataMap.dataFinancial['2011']},
                        {'data': dataMap.dataEstate['2011']},
                        {'data': dataMap.dataPI['2011']},
                        {'data': dataMap.dataSI['2011']},
                        {'data': dataMap.dataTI['2011']}
                    ]
                }
            ]
        };
        myChart4.setOption(option4);

    });
</script>