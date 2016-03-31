@extends('layouts.app')
@section('custom-style')
    <style>
        .tools-block div,
        .tools-block-end-ticket div{
            color: #333;
            display: none;
            font-weight: bold;
        }
        .tools-block div:first-child,
        .tools-block-end-ticket div:first-child{
            display: block;
        }
    </style>
@endsection
@section('content')

    <div>
        <input class="form-control input-lg" id="search" type="text" placeholder="Ім'я клієнта або номер абонимента">
    </div>
    <br>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box box-warning">
                <div class="content-dashboard">
                    @include('search.graph')
                </div>
            </div>
        </div>
    </div>
    <br>
@endsection

@section('footer-info')
    <section class="content-dashboard-footer">
        <div class="box box-primary content-box">

                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="box box-widget widget-user-2 widget-user-header dashboard_footer">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-image">
                            <img class="img-circle" src="/img/birthday-cake1.jpg" alt="User Avatar">
                        </div>
                        <!-- /.widget-user-image -->
                        <div class="tools-block">
                            @for ($i=0;$i<count($birthdays);$i=$i+3)

                                    <div>
                                        <a href="clients/{{$birthdays[$i]->id}}"><h5 class="widget-user-desc">{{$birthdays[$i]->birthday}} - {{$birthdays[$i]->name}}</h5></a>
                                        @if($i+1<count($birthdays))
                                            <a href="clients/{{$birthdays[$i+1]->id}}"><h5 class="widget-user-desc">{{$birthdays[$i+1]->birthday}} - {{$birthdays[$i+1]->name}}</h5></a>
                                        @endif
                                        @if($i+2<count($birthdays))
                                            <a href="clients/{{$birthdays[$i+2]->id}}"><h5 class="widget-user-desc">{{$birthdays[$i+2]->birthday}} - {{$birthdays[$i+2]->name}}</h5></a>
                                        @endif
                                    </div>

                            @endfor
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="box box-widget widget-user-2 widget-user-header dashboard_footer">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-image">
                            <img class="img-circle" src="/img/ticket-icon_1.png" alt="User Avatar">
                        </div>
                        <!-- /.widget-user-image -->
                        <div class="tools-block-end-ticket">
                            @for ($i=0;$i<count($endOfDateTickets);$i=$i+3)
                                <div>
                                    <a href="clients/{{$endOfDateTickets[$i]->getNameClient->id}}"><h5 class="widget-user-desc">№ {{$endOfDateTickets[$i]->numTicket}} [ {{$endOfDateTickets[$i]->dateFromReserve}} ] - {{$endOfDateTickets[$i]->getNameClient->name}}</h5></a>
                                    @if($i+1<count($endOfDateTickets))
                                        <a href="clients/{{$endOfDateTickets[$i+1]->getNameClient->id}}"><h5 class="widget-user-desc">№ {{$endOfDateTickets[$i+1]->numTicket}} [ {{$endOfDateTickets[$i+1]->dateFromReserve}} ] - {{$endOfDateTickets[$i+1]->getNameClient->name}}</h5></a>
                                    @endif
                                    @if($i+2<count($endOfDateTickets))
                                        <a href="clients/{{$endOfDateTickets[$i+2]->getNameClient->id}}"><h5 class="widget-user-desc">№ {{$endOfDateTickets[$i+2]->numTicket}} [ {{$endOfDateTickets[$i+2]->dateFromReserve}} ] - {{$endOfDateTickets[$i+2]->getNameClient->name}}</h5></a>
                                    @endif
                                </div>
                            @endfor
                        </div>

                    </div>
                </div>
        </div>
    </section>
@endsection

@section('custom-scripts')

    <script>
        $(document).ready(function(){
            $('#search').on('keyup', function () {
                var value = $(this).val();
                if ((value.length>=3)||((value[0]!='0')&&(value[0]!='+')&&($.isNumeric(value)))) {

                    if ((value.length>=5)&&(value[0] ='+')){
                        value = value.substr(3);
    //                    console.log(value);
                    }

                    $.ajax({
                        method: "POST",
                        url: "/search",
                        timeout: 500,
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "search": value
                        }
                    }).done(function (data) {
                        if(data) {
                            $('.content-dashboard').html(data);
                        }else{
                            getGraph();
                        }
                    })
                }else{
                    getGraph();
                }

            });

            function getGraph(){
                $.ajax({
                    method: "get",
                    timeout: 500,
                    url: "/search/graph",
                }).done(function (data) {
                    $('.content-dashboard').html(data);
                })
            }



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

        });

    </script>

@stop

