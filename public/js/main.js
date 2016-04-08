toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-bottom-right",
    "preventDuplicates": true,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

function checkEvent(token,client_id,event){
    return $.ajax({
        method: "POST",
        url: "/event/addEvents",
        data: {
            "_token": token,
            "id_event": event,
            "id_client": client_id,
        }
    });
}

function resize() {
    $('.tickets-accordion ul').height($('.content-dashboard').height() - 200);
}

$('.dropdown select').on("click", function(e){
    e.stopPropagation();
    e.preventDefault();
    $(this).change(function(){
        document.location.href="/changeChapters/"+$(this).val();
    });
});

resize();

$(window).resize(function(){
    resize()
});
