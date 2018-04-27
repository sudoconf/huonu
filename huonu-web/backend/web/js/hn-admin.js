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

// 加载中
function SHOW_LOAD_LAYER(){
    // return layer.msg('努力中...', {icon: 16,shade: [0.1, '#f5f5f5'],scrollbar: false,offset: '50%', time:1000000}) ;
    var ii = layer.load(2, {shade: [0.5]})
    //此处用setTimeout演示ajax的回调
    setTimeout(function(){
        layer.close(ii);
    }, 1000);
}
// 关闭
function CLOSE_LOAD_LAYER(index){
    layer.close(index);
}


// 客户计划
$('.plan-table tr:even').hover(function () {
    // console.log($(this).index(this))
    $('.plan-table tr:odd').hide();
    $(this).next().show();
});

$('.ux-status-handle').hover(function () {
    $(this).find('.ux-status-info').show();
}, function () {
    $(this).find('.ux-status-info').hide();
});