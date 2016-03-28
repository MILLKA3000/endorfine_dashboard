<div>
    <div class="col-md-12 col-sm-12 col-xs-12 responsive">
        <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-calendar"></i></span>

            <div class="info-box-content">
                <div class="col-md-3">
                    <span class="info-box-text">Ім'я</span>
                    <span class="info-box-text">{{$clients->name}}</span>
                </div>
                <div class="col-md-3">
                    <span class="info-box-text">День нардження</span>
                    <span class="info-box-text">{{$clients->birthday}}</span>
                </div>
                <div class="col-md-3">
                    <span class="info-box-text">Телефон</span>
                    <span class="info-box-text">{{$clients->phone}}</span>
                </div>
                <div class="col-md-3">
                <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                </div>
                  <span class="progress-description">
                    70% Increase in 30 Days
                  </span>
                </div>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    {{--<div class="row">--}}

        {{--<div class="col-md-3">{{$clients->photo}}</div>--}}
        {{--<div class="col-md-9">--}}
            {{--<div class="row">--}}
                {{--<div class="col-md-4">Ім'я</div>--}}
                {{--<div class="col-md-4">День нардження</div>--}}
                {{--<div class="col-md-4">Телефон</div>--}}
            {{--</div>--}}
            {{--<div class="row">--}}
                {{--<div class="col-md-4" style="color:#ffffff"><span style="background: rgb(68, 68, 68);">{{$clients->name}}</span></div>--}}
                {{--<div class="col-md-4" style="color:#ffffff"><span style="background: rgb(68, 68, 68);">{{$clients->phone}}</span></div>--}}
                {{--<div class="col-md-4" style="color:#ffffff"><span style="background: rgb(68, 68, 68);">{{$clients->birthday}}</span></div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
</div>