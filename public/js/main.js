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
    }).done(function (data) {
        showToastr(data);
    });;
}

function delEvent(token,client_id,event){
    return $.ajax({
        method: "POST",
        url: "/event/deleteEvents",
        data: {
            "_token": token,
            "id_event": event,
            "id_client": client_id,
        }
    }).done(function (data) {
        showToastr(data);
    });
}

function showToastr(data){
    var obj = jQuery.parseJSON(data);
    if(obj.countAllTicketAccess !== undefined) {
        $('#countAllTicketAccess').text(obj.countAllTicketAccess);
    }
    if(obj.status !== undefined){
        toastr["success"](obj.status);
    }else{
        toastr["error"](obj.error);
    }

    var tables = $.fn.dataTable.fnTables(true);

    $(tables).each(function () {
        $(this).dataTable().fnClearTable();
        $(this).dataTable().fnDestroy();
    });

    $(".table").dataTable();
    $('#calendar').fullCalendar('removeEvents');
    $('#calendar').fullCalendar( 'addEventSource', obj.calendar);
    $('#calendar').fullCalendar('refetchEvents');
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
