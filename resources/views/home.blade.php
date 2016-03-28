@extends('layouts.app')

@section('content')
    <!-- Info boxes -->
    {{--<div class="row">--}}
        {{--<div class="col-md-3 col-sm-6 col-xs-12">--}}
            {{--<div class="info-box">--}}
                {{--<span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>--}}

                {{--<div class="info-box-content">--}}
                    {{--<span class="info-box-text">CPU Traffic</span>--}}
                    {{--<span class="info-box-number">90<small>%</small></span>--}}
                {{--</div>--}}
                {{--<!-- /.info-box-content -->--}}
            {{--</div>--}}
            {{--<!-- /.info-box -->--}}
        {{--</div>--}}
        {{--<!-- /.col -->--}}
        {{--<div class="col-md-3 col-sm-6 col-xs-12">--}}
            {{--<div class="info-box">--}}
                {{--<span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>--}}

                {{--<div class="info-box-content">--}}
                    {{--<span class="info-box-text">Likes</span>--}}
                    {{--<span class="info-box-number">41,410</span>--}}
                {{--</div>--}}
                {{--<!-- /.info-box-content -->--}}
            {{--</div>--}}
            {{--<!-- /.info-box -->--}}
        {{--</div>--}}
        {{--<!-- /.col -->--}}

        {{--<!-- fix for small devices only -->--}}
        {{--<div class="clearfix visible-sm-block"></div>--}}

        {{--<div class="col-md-3 col-sm-6 col-xs-12">--}}
            {{--<div class="info-box">--}}
                {{--<span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>--}}

                {{--<div class="info-box-content">--}}
                    {{--<span class="info-box-text">Sales</span>--}}
                    {{--<span class="info-box-number">760</span>--}}
                {{--</div>--}}
                {{--<!-- /.info-box-content -->--}}
            {{--</div>--}}
            {{--<!-- /.info-box -->--}}
        {{--</div>--}}
        {{--<!-- /.col -->--}}
        {{--<div class="col-md-3 col-sm-6 col-xs-12">--}}
            {{--<div class="info-box">--}}
                {{--<span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>--}}

                {{--<div class="info-box-content">--}}
                    {{--<span class="info-box-text">New Members</span>--}}
                    {{--<span class="info-box-number">2,000</span>--}}
                {{--</div>--}}
                {{--<!-- /.info-box-content -->--}}
            {{--</div>--}}
            {{--<!-- /.info-box -->--}}
        {{--</div>--}}
        {{--<!-- /.col -->--}}
    {{--</div>--}}
    <!-- /.row -->
    <div class="text-center text-warning">
        <h1>Вас вітає Endirfine</h1>
    </div>
    <div>
        <input class="form-control input-lg" type="text" placeholder="Ім'я клієнта або номер абонимента">
    </div>
<br>
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="box box-warning">
            Контент
            </div>
        </div>
    </div>
<br>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box box-warning">
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
        </div>
    </div>
@endsection
