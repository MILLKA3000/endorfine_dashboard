$(".tools-block div:first").css("display", "block");
$(".tools-block-end-ticket div:first").css("display", "block");

jQuery.fn.timer = function() {
    if($(this).children('div').length > 1)
        if(!$(this).children("div:last-child").is(":visible")){
            $(this).children("div:visible").fadeOut(500, function () {
                $(this).next("div").fadeIn(500);
            });
        }
        else{
            $(this).children("div:visible").hide().end().children("div:first").fadeIn(500);
        }
}

window.setInterval(function() {
    $(".tools-block").timer();
    $(".tools-block-end-ticket").timer();
}, 5000);