$(function () {

    $(".creativeImg").hover(function () {
        $(".creativeImg").mousemove(function(e){
            $(this).siblings().css({
                "top": (e.pageY - 190) + "px",
                "left": (e.pageX - 200) + "px"
            }).removeClass('hide')
        });
    }, function () {
        $('.pic-preview').addClass('hide');
    });


});