@extends('layouts.app')
{{-- Content --}}
@section('content')


        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="img-responsive" style="width: 100%" src="{{ URL::to('/photo/'.$client->id.'.png') }}" alt="Фото клієнта">

                        <h3 class="profile-username text-center">{{$client->name}}</h3>

                        <p class="text-muted text-center">{{$client->getNameStatus->name}}</p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Абонемент</b> <a class="pull-right">{{$client->getActiveTickets->first()->numTicket}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Знижка</b> <a class="pull-right"><small class="label label-success">({{$client->getNameStatus->getNameDiscountForClients->percent}}%)</small></a>
                            </li>
                            <li class="list-group-item">
                                <b>День народження</b> <a class="pull-right">{{$client->birthday}}</a>
                            </li>
                            <li class="list-group-item">
                                {{--<b>Загальна кількість занять</b> <a class="pull-right">{{$client->getActiveTraning->getQtyTicket->qtySessions}}</a>--}}
                                <b>Загальна кількість занять</b> <a class="pull-right">1</a>
                            </li>
                        </ul>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <!-- About Me Box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Детальніше</h3>
                    </div>
                    <!-- /.box-header -->
                        <div class="box-body">

                            <strong><i class="fa fa-file-text-o margin-r-5"></i> Користувач створений</strong>

                            <p class="pull-right">{{$client->created_at}}</p>
                        </div>
                        <div class="box-body">

                            @if (!empty($client->detail))

                                <strong><i class="fa fa-file-text-o margin-r-5"></i> Опис</strong>

                                <p>{{$client->detail}}</p>

                            @endif
                        </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity" data-toggle="tab">Абонементи</a></li>
                        <li><a href="#timeline" data-toggle="tab">Календар</a></li>
                        <li><a href="#settings" data-toggle="tab">Профіль</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <div class="bottom-menu-header">
                                <h3>
                                    Абонементи
                                    <div class="pull-right">
                                        <div class="pull-right">
                                            <a href="/clients/{{$client->id}}/joinTicket"
                                               class="btn btn-sm  btn-primary"><span class="glyphicon glyphicon-plus-sign"></span>Добавити абонемент</a>
                                        </div>
                                    </div>
                                </h3>
                            </div>
                            <table id="table2" class="table responsive no-wrap table-bordered table-hover dataTable"
                                   data-paging="true"
                                   data-ajax="/clients/getAllTickets/{{$client->id}}"
                                   data-page-length="25"
                                   width="100%">
                                <thead>
                                <tr>
                                    <th data-sortable="true" data-filterable="select" width="10%">Абонементи</th>
                                    <th data-sortable="true" width="10%">Кількість занять</th>
                                    <th data-sortable="true" width="10%">Дата закінчення</th>
                                    <th data-sortable="true" data-filterable="text" width="10%">Знижка</th>
                                    <th data-sortable="true" data-filterable="select" width="10%">Активний</th>

                                    <th width="10%">Дія</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>

                        <div class="tab-pane" id="timeline">

                        </div>

                        <div class="tab-pane" id="settings">
                            <div class="bottom-menu-header">
                                <h3>
                                    Особисті дані клієнта
                                    <div class="pull-right">
                                        <div class="pull-right">

                                        </div>
                                    </div>
                                </h3>
                            </div>
                            {!! Form::model($client, array('url' => URL::to('clients') . '/' . $client->id.'/edit', 'method' => 'PUT', 'class' => 'bf row', 'files'=> true)) !!}

                                <div class="col-md-8">
                                    <div class="form-group  {{ $errors->has('name') ? 'has-error' : '' }}">
                                        {!! Form::label('name', 'Ім\'я', array('class' => 'control-label')) !!}
                                        <div class="controls">
                                            {!! Form::text('name', null, array('class' => 'form-control')) !!}
                                            <span class="help-block">{{ $errors->first('name', ':message') }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group  {{ $errors->has('phone') ? 'has-error' : '' }}">
                                        {!! Form::label('phone', 'Телефон', array('class' => 'control-label')) !!}

                                        <div class="input-group">
                                            <div class="input-group-addon {{ $errors->has('phone') ? 'has-error' : '' }}">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            {!! Form::text('phone', null, array('class' => 'form-control','data-inputmask'=>'\'mask\': \'(999) 999-99-99\'','data-mask'=>'')) !!}

                                        </div>
                                        <span class="help-block">{{ $errors->first('phone', ':message') }}</span>
                                    </div>
                                    <div class="form-group  {{ $errors->has('birthday') ? 'has-error' : '' }}">
                                        {!! Form::label('birthday', 'Дата народження', array('class' => 'control-label')) !!}
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            {!! Form::date('birthday', \Carbon\Carbon::now(), array('class' => 'form-control','data-inputmask'=>'\'alias\': \'mm/dd/yyyy\'','data-mask'=>'')) !!}
                                            <span class="help-block">{{ $errors->first('birthday', ':message') }}</span>
                                        </div>
                                    </div>

                                    <div class="form-group  {{ $errors->has('status_id') ? 'has-error' : '' }}">
                                        {!! Form::label('status_id', 'Статус кліента', array('class' => 'control-label')) !!}
                                        <div class="controls">
                                            {!! Form::select('status_id', $statuses->lists('name', 'id'), 1,array('class' => 'form-control')) !!}
                                            <span class="help-block">{{ $errors->first('status_id', ':message') }}</span>
                                        </div>
                                    </div>

                                    <div class="form-group  {{ $errors->has('detail') ? 'has-error' : '' }}">
                                        {!! Form::label('detail', 'Опис', array('class' => 'control-label')) !!}
                                        <div class="controls">
                                            {!! Form::textarea('detail', null, array('class' => 'form-control','rows'=>3)) !!}
                                            <span class="help-block">{{ $errors->first('detail', ':message') }}</span>
                                        </div>
                                    </div>

                                    <div class="form-group  {{ $errors->has('enabled') ? 'has-error' : '' }}">
                                        {!! Form::label('enabled', 'Активний?', array('class' => 'control-label')) !!}
                                        <div class="controls">
                                            {!! Form::label('enabled', 'Так', array('class' => 'control-label')) !!}
                                            {!! Form::radio('enabled', '1', 1) !!}
                                            {!! Form::label('enabled', 'Ні', array('class' => 'control-label')) !!}
                                            {!! Form::radio('enabled', '0', 0) !!}
                                            <span class="help-block">{{ $errors->first('enabled', ':message') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">

                                    <div class="form-group  {{ $errors->has('photo') ? 'has-error' : '' }}">
                                        {!! Form::label('photo', 'Фото', array('class' => 'control-label')) !!}
                                        <div class="controls">
                                            <div class="box box-success">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title">Веб камера</h3>
                                                </div>
                                                <div class="box-body">
                                                    <div id="webcam" class="center"></div>
                                                    {!! Form::textarea('photo', '', array('class' => 'form-control photo-client','style'=>'display:none')) !!}
                                                    <span class="help-block">{{ $errors->first('photo', ':message') }}</span>
                                                    <a href="javascript:webcam.capture();void(0);" class="btn btn-sm btn-default">Зробити фото</a>
                                                    <div id="photo"></div>
                                                </div>
                                            </div>

                                            <div class="box box-success">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title">Фото клієнта</h3>
                                                </div>
                                                <div class="box-body">
                                                    <img id="example" class="img-responsive center-block text-center" src="" alt="Приклад фото клієнта">
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button type="reset" class="btn btn-sm btn-default">
                                            <span class="glyphicon glyphicon-remove-circle"></span> Очистити
                                        </button>
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <span class="glyphicon glyphicon-ok-circle"></span> Зберегти
                                        </button>
                                    </div>
                                </div>

                            {!! Form::close() !!}
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
@endsection
{{-- Scripts --}}
@section('custom-scripts')
    <script src="{{ asset('js/dataTablesSelect.js') }}"></script>
    <script src="{{ asset ("/bower_components/AdminLTE/plugins/input-mask/jquery.inputmask.js") }}"></script>
    <script src="{{ asset ("/bower_components/AdminLTE/plugins/input-mask/jquery.inputmask.phone.extensions.js") }}"></script>
    <script src="{{ asset ("/bower_components/AdminLTE/plugins/input-mask/jquery.inputmask.extensions.js") }}"></script>
    <script src="{{ asset ("/bower_components/AdminLTE/plugins/jQuery/jquery.webcam.js") }}"></script>

    <script>
        $(function() {
            $("#phone").inputmask();

            var pos = 0, ctx = null, saveCB, image = [];

            var canvas = document.createElement("canvas");
            canvas.setAttribute('width', 320);
            canvas.setAttribute('height', 240);

            if (canvas.toDataURL) {

                ctx = canvas.getContext("2d");

                image = ctx.getImageData(0, 0, 320, 240);

                saveCB = function(data) {

                    var col = data.split(";");
                    var img = image;

                    for(var i = 0; i < 320; i++) {
                        var tmp = parseInt(col[i]);
                        img.data[pos + 0] = (tmp >> 16) & 0xff;
                        img.data[pos + 1] = (tmp >> 8) & 0xff;
                        img.data[pos + 2] = tmp & 0xff;
                        img.data[pos + 3] = 0xff;
                        pos+= 4;
                    }

                    if (pos >= 4 * 320 * 240) {
                        ctx.putImageData(img, 0, 0);
                        $('.photo-client').val(canvas.toDataURL("image/png"));
                        $('#example').attr('src', canvas.toDataURL("image/png"));
                        pos = 0;
                    }
                };

            } else {

                saveCB = function(data) {
                    image.push(data);

                    pos+= 4 * 320;

                    if (pos >= 4 * 320 * 240) {
                        $.post("/photoPut", {type: "pixel", image: image.join('|')});
                        pos = 0;
                    }
                };
            }

            $("#webcam").webcam({

                width: '100%',
                height: 150,
                mode: "callback",
                swffile: "{{ asset ("/bower_components/AdminLTE/plugins/jQuery/jscam_canvas_only.swf") }}",

                onSave: saveCB,

                onCapture: function () {
                    webcam.save();
                },

                debug: function (type, string) {
                    console.log(type + ": " + string);
                }
            });

        });

        $('#table2').dataTableHelper({responsive: true});
    </script>

@stop