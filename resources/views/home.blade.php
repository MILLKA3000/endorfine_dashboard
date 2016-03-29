@extends('layouts.app')

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
                        <a href="/clients/id">
                            @foreach ($birthdays as $birthday)
                                <a href="clients/{{$birthday->id}}"><h5 class="widget-user-desc">{{$birthday->birthday}} - {{$birthday->name}}</h5></a>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="box box-widget widget-user-2 widget-user-header dashboard_footer">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-image">
                            <img class="img-circle" src="/img/ticket-icon_1.png" alt="User Avatar">
                        </div>
                        <!-- /.widget-user-image -->
                        <a href="/clients/id">
                            @foreach ($datas as $data)
                                <a href="clients/{{$birthday->id}}"><h5 class="widget-user-desc">{{$data->enddate}} - {{$data->name}}</h5></a>
                        @endforeach
                    </div>
                </div>
        </div>
    </section>
@endsection

@section('custom-scripts')

    <script>
        $('#search').on('keyup', function () {
            var value = $(this).val();
            if (value.length>=3) {
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

    </script>

@stop

