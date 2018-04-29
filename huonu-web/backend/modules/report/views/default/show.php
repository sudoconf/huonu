<?php

use yii\helpers\Html;
use yii\helpers\Url;

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
                <a href="#">客户报表</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">人群复盘详情</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="testChart" id="testChart" style="width: 100%; height: 600px;"></div>
            <div class="testChart1" id="testChart1" style="width: 100%; height: 600px;"></div>
            <div class="testChart2" id="testChart2" style="width: 100%; height: 600px;"></div>
            <div class="testChart3" id="testChart3" style="width: 100%; height: 600px;"></div>
        </div>
    </div>

</div>


<?= Html::jsFile('@web/vendor/echarts-2.2.7/echarts-all.js') ?>
<?= Html::jsFile('@web/js/timelineOption.js') ?>

<script type="text/javascript">
//初始化echarts实例
var myChart = echarts.init(document.getElementById('testChart'));

var option = {
    title : {
        text: '未来一周气温变化',
        subtext: '纯属虚构'
    },
    tooltip : {
        trigger: 'axis'
    },
    legend: {
        data:['最高气温','最低气温']
    },
    toolbox: {
        show : true,
        feature : {
            mark : {show: true},
            dataView : {show: true, readOnly: false},
            magicType : {show: true, type: ['line', 'bar']},
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    calculable : true,
    xAxis : [
        {
            type : 'category',
            boundaryGap : false,
            data : ['周一','周二','周三','周四','周五','周六','周日']
        }
    ],
    yAxis : [
        {
            type : 'value',
            axisLabel : {
                formatter: '{value} °C'
            }
        }
    ],
    series : [
        {
            name:'最高气温',
            type:'line',
            data:[11, 11, 15, 13, 12, 13, 10],
            markPoint : {
                data : [
                    {type : 'max', name: '最大值'},
                    {type : 'min', name: '最小值'}
                ]
            },
            markLine : {
                data : [
                    {type : 'average', name: '平均值'}
                ]
            }
        },
        {
            name:'最低气温',
            type:'line',
            data:[1, -2, 2, 5, 3, 2, 0],
            markPoint : {
                data : [
                    {name : '周最低', value : -2, xAxis: 1, yAxis: -1.5}
                ]
            },
            markLine : {
                data : [
                    {type : 'average', name : '平均值'}
                ]
            }
        }
    ]
};

//使用制定的配置项和数据显示图表
myChart.setOption(option);

var myChart1 = echarts.init(document.getElementById('testChart1'));
var option1 = {
    title : {
        text: '某站点用户访问来源',
        subtext: '纯属虚构',
        x:'center'
    },
    tooltip : {
        trigger: 'item',
        formatter: "{a} <br/>{b} : {c} ({d}%)"
    },
    legend: {
        orient : 'vertical',
        x : 'left',
        data:['直接访问','邮件营销','联盟广告','视频广告','搜索引擎']
    },
    toolbox: {
        show : true,
        feature : {
            mark : {show: true},
            dataView : {show: true, readOnly: false},
            magicType : {
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
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    calculable : true,
    series : [
        {
            name:'访问来源',
            type:'pie',
            radius : '55%',
            center: ['50%', '60%'],
            data:[
                {value:335, name:'直接访问'},
                {value:310, name:'邮件营销'},
                {value:234, name:'联盟广告'},
                {value:135, name:'视频广告'},
                {value:1548, name:'搜索引擎'}
            ]
        }
    ]
};
myChart1.setOption(option1);


var myChart2 = echarts.init(document.getElementById('testChart2'));
var option2 = {
    title : {
        text: '某地区蒸发量和降水量',
        subtext: '纯属虚构'
    },
    tooltip : {
        trigger: 'axis'
    },
    legend: {
        data:['蒸发量','降水量']
    },
    toolbox: {
        show : true,
        feature : {
            mark : {show: true},
            dataView : {show: true, readOnly: false},
            magicType : {show: true, type: ['line', 'bar']},
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    calculable : true,
    xAxis : [
        {
            type : 'category',
            data : ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月']
        }
    ],
    yAxis : [
        {
            type : 'value'
        }
    ],
    series : [
        {
            name:'蒸发量',
            type:'bar',
            data:[2.0, 4.9, 7.0, 23.2, 25.6, 76.7, 135.6, 162.2, 32.6, 20.0, 6.4, 3.3],
            markPoint : {
                data : [
                    {type : 'max', name: '最大值'},
                    {type : 'min', name: '最小值'}
                ]
            },
            markLine : {
                data : [
                    {type : 'average', name: '平均值'}
                ]
            }
        },
        {
            name:'降水量',
            type:'bar',
            data:[2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6, 182.2, 48.7, 18.8, 6.0, 2.3],
            markPoint : {
                data : [
                    {name : '年最高', value : 182.2, xAxis: 7, yAxis: 183, symbolSize:18},
                    {name : '年最低', value : 2.3, xAxis: 11, yAxis: 3}
                ]
            },
            markLine : {
                data : [
                    {type : 'average', name : '平均值'}
                ]
            }
        }
    ]
};
myChart2.setOption(option2);


var myChart3 = echarts.init(document.getElementById('testChart3'));
var option3 = {
    timeline:{
        data:[
            '2002-01-01','2003-01-01','2004-01-01','2005-01-01','2006-01-01',
            '2007-01-01','2008-01-01','2009-01-01','2010-01-01','2011-01-01'
        ],
        label : {
            formatter : function(s) {
                return s.slice(0, 4);
            }
        },
        autoPlay : true,
        playInterval : 1000
    },
    options:[
        {
            title : {
                'text':'2002全国宏观经济指标',
                'subtext':'数据来自国家统计局'
            },
            tooltip : {'trigger':'axis'},
            legend : {
                x:'right',
                'data':['GDP','金融','房地产','第一产业','第二产业','第三产业'],
                'selected':{
                    'GDP':true,
                    '金融':false,
                    '房地产':true,
                    '第一产业':false,
                    '第二产业':false,
                    '第三产业':false
                }
            },
            toolbox : {
                'show':true, 
                orient : 'vertical',
                x: 'right', 
                y: 'center',
                'feature':{
                    'mark':{'show':true},
                    'dataView':{'show':true,'readOnly':false},
                    'magicType':{'show':true,'type':['line','bar','stack','tiled']},
                    'restore':{'show':true},
                    'saveAsImage':{'show':true}
                }
            },
            calculable : true,
            grid : {'y':80,'y2':100},
            xAxis : [{
                'type':'category',
                'axisLabel':{'interval':0},
                'data':[
                    '北京','\n天津','河北','\n山西','内蒙古','\n辽宁','吉林','\n黑龙江',
                    '上海','\n江苏','浙江','\n安徽','福建','\n江西','山东','\n河南',
                    '湖北','\n湖南','广东','\n广西','海南','\n重庆','四川','\n贵州',
                    '云南','\n西藏','陕西','\n甘肃','青海','\n宁夏','新疆'
                ]
            }],
            yAxis : [
                {
                    'type':'value',
                    'name':'GDP（亿元）',
                    'max':53500
                },
                {
                    'type':'value',
                    'name':'其他（亿元）'
                }
            ],
            series : [
                {
                    'name':'GDP',
                    'type':'bar',
                    'markLine':{
                        symbol : ['arrow','none'],
                        symbolSize : [4, 2],
                        itemStyle : {
                            normal: {
                                lineStyle: {color:'orange'},
                                barBorderColor:'orange',
                                label:{
                                    position:'left',
                                    formatter:function(params){
                                        return Math.round(params.value);
                                    },
                                    textStyle:{color:'orange'}
                                }
                            }
                        },
                        'data':[{'type':'average','name':'平均值'}]
                    },
                    'data': dataMap.dataGDP['2002']
                },
                {
                    'name':'金融','yAxisIndex':1,'type':'bar',
                    'data': dataMap.dataFinancial['2002']
                },
                {
                    'name':'房地产','yAxisIndex':1,'type':'bar',
                    'data': dataMap.dataEstate['2002']
                },
                {
                    'name':'第一产业','yAxisIndex':1,'type':'bar',
                    'data': dataMap.dataPI['2002']
                },
                {
                    'name':'第二产业','yAxisIndex':1,'type':'bar',
                    'data': dataMap.dataSI['2002']
                },
                {
                    'name':'第三产业','yAxisIndex':1,'type':'bar',
                    'data': dataMap.dataTI['2002']
                }
            ]
        },
        {
            title : {'text':'2003全国宏观经济指标'},
            series : [
                {'data': dataMap.dataGDP['2003']},
                {'data': dataMap.dataFinancial['2003']},
                {'data': dataMap.dataEstate['2003']},
                {'data': dataMap.dataPI['2003']},
                {'data': dataMap.dataSI['2003']},
                {'data': dataMap.dataTI['2003']}
            ]
        },
        {
            title : {'text':'2004全国宏观经济指标'},
            series : [
                {'data': dataMap.dataGDP['2004']},
                {'data': dataMap.dataFinancial['2004']},
                {'data': dataMap.dataEstate['2004']},
                {'data': dataMap.dataPI['2004']},
                {'data': dataMap.dataSI['2004']},
                {'data': dataMap.dataTI['2004']}
            ]
        },
        {
            title : {'text':'2005全国宏观经济指标'},
            series : [
                {'data': dataMap.dataGDP['2005']},
                {'data': dataMap.dataFinancial['2005']},
                {'data': dataMap.dataEstate['2005']},
                {'data': dataMap.dataPI['2005']},
                {'data': dataMap.dataSI['2005']},
                {'data': dataMap.dataTI['2005']}
            ]
        },
        {
            title : {'text':'2006全国宏观经济指标'},
            series : [
                {'data': dataMap.dataGDP['2006']},
                {'data': dataMap.dataFinancial['2006']},
                {'data': dataMap.dataEstate['2006']},
                {'data': dataMap.dataPI['2006']},
                {'data': dataMap.dataSI['2006']},
                {'data': dataMap.dataTI['2006']}
            ]
        },
        {
            title : {'text':'2007全国宏观经济指标'},
            series : [
                {'data': dataMap.dataGDP['2007']},
                {'data': dataMap.dataFinancial['2007']},
                {'data': dataMap.dataEstate['2007']},
                {'data': dataMap.dataPI['2007']},
                {'data': dataMap.dataSI['2007']},
                {'data': dataMap.dataTI['2007']}
            ]
        },
        {
            title : {'text':'2008全国宏观经济指标'},
            series : [
                {'data': dataMap.dataGDP['2008']},
                {'data': dataMap.dataFinancial['2008']},
                {'data': dataMap.dataEstate['2008']},
                {'data': dataMap.dataPI['2008']},
                {'data': dataMap.dataSI['2008']},
                {'data': dataMap.dataTI['2008']}
            ]
        },
        {
            title : {'text':'2009全国宏观经济指标'},
            series : [
                {'data': dataMap.dataGDP['2009']},
                {'data': dataMap.dataFinancial['2009']},
                {'data': dataMap.dataEstate['2009']},
                {'data': dataMap.dataPI['2009']},
                {'data': dataMap.dataSI['2009']},
                {'data': dataMap.dataTI['2009']}
            ]
        },
        {
            title : {'text':'2010全国宏观经济指标'},
            series : [
                {'data': dataMap.dataGDP['2010']},
                {'data': dataMap.dataFinancial['2010']},
                {'data': dataMap.dataEstate['2010']},
                {'data': dataMap.dataPI['2010']},
                {'data': dataMap.dataSI['2010']},
                {'data': dataMap.dataTI['2010']}
            ]
        },
        {
            title : {'text':'2011全国宏观经济指标'},
            series : [
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
myChart3.setOption(option3);
</script>