$(function () {
    $('#side-menu').metisMenu({
        toggle: false
    });
});

$(function () {
    $(window).bind("load resize", function () {
        var topOffset = 50;
        var width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        var height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });

    var url = window.location;
    // var element = $('ul.nav a').filter(function() {
    //     return this.href == url;
    // }).addClass('active').parent().parent().addClass('in').parent();
    var element = $('ul.nav a').filter(function () {
        return this.href == url;
    }).addClass('active').parent();

    while (true) {
        if (element.is('li')) {
            element = element.parent().addClass('in').parent();
        } else {
            break;
        }
    }


});

$('.create-user-button').click(function () {
    layer.open({
        type: 1,
        title: '创建角色',
        shadeClose: true,
        shade: false,
        maxmin: false, //开启最大化最小化按钮
        area: ['462px', '430px'],
        content: $('.layer-form-create-user').html()
    });
});

$('.reset-password').click(function () {
    layer.open({
        type: 1,
        title: '重置密码',
        shadeClose: true,
        shade: false,
        maxmin: false, //开启最大化最小化按钮
        area: ['462px', '430px'],
        content: $('.layer-form-reset-password').html()
    });
});

$('.del').click(function () {
    layer.confirm('是否删除?', {icon: 3, title: '提示'}, function (index) {

        layer.close(index);
    });
});

// 客户计划
$('.plan-table tr:even').hover(function () {
    // console.log($(this).index(this))
    $('.plan-table tr:odd').hide();
    $(this).next().show();
});

$(".ux-status-handle").hover(function () {
    $('.ux-status-info').show();
}, function () {
    $('.ux-status-info').hide();
});

// 时间段选择
// var cb = function (start, end, label) {
//     $('.select-time span').html(start.format('YYYY-MM-DD HH:mm:ss'));
// };
//
// var optionSet = {
//     'startDate': moment().hours(4).minutes(0).seconds(0),
//     'endDate': moment().endOf('day'),
//     'timePicker': true,
//     'ranges': {
//         // '最近1小时': [moment().subtract('hours',1), moment()],
//         '今天': [moment().startOf('day'), moment()],
//         '昨天': [moment().subtract(1, 'days').startOf('day'), moment().subtract(1, 'days').endOf('day')],
//         '7天': [moment().subtract(7, 'days').startOf('day'), moment().endOf('day')],
//         '15天': [moment().subtract(15, 'days').startOf('day'), moment().endOf('day')],
//         '30天': [moment().subtract(30, 'days').startOf('day'), moment().endOf('day')],
//         '这个月': [moment().startOf('month').startOf('day'), moment().endOf('month').endOf('day')],
//         '上个月': [moment().subtract(1, 'month').startOf('month').startOf('day'), moment().subtract(1, 'month').endOf('month').endOf('day')]
//     },
//     'locale': {
//         'format': 'YYYY-MM-DD HH:mm:ss',
//         "separator": " - ",
//         "applyLabel": "确定",
//         "cancelLabel": "取消",
//         "fromLabel": "起始时间",
//         "toLabel": "结束时间'",
//         "customRangeLabel": "自定义",
//         "weekLabel": "W",
//         'daysOfWeek': ['日', '一', '二', '三', '四', '五', '六'],
//         'monthNames': ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
//     },
//     'opens': 'right',
//     'drops': 'down',
//     'format': 'YYYY-MM-DD HH:mm:ss',
// };
// $('.select-time').daterangepicker(optionSet, cb);

// 拖动排序
// $('ul.custom-fields').sortable();

// 加载中
function SHOW_LOAD_LAYER(){
    // return layer.msg('努力中...', {icon: 16,shade: [0.1, '#f5f5f5'],scrollbar: false,offset: '50%', time:1000000}) ;
    var ii = layer.load(2, {shade: [0.5, '#f5f5f5']})
    //此处用setTimeout演示ajax的回调
    setTimeout(function(){
        layer.close(ii);
    }, 1000);
}
function CLOSE_LOAD_LAYER(index){
    layer.close(index);
}