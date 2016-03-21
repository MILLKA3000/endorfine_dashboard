@extends('layouts.app')
@section('custom-style')
    <style>
        .content-wrapper{
            display: inline-flex;
        }
    </style>
@endsection
{{-- Content --}}
@section('content')
    <div class="bottom-menu-header">
        <h3>
            Створення Кліента
            <div class="pull-right">
                <div class="pull-right">

                </div>
            </div>
        </h3>
    </div>

{!! Form::open(array('url' => URL::to('/clients'), 'method' => 'UPDATE', 'class' => 'bf', 'files'=> true)) !!}
        <!-- Tabs Content -->
<div class="tab-content">
    <!-- General tab -->
    <div class="tab-pane active" id="tab-general">
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
                    <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                    </div>
                    {!! Form::text('phone', null, array('class' => 'form-control','data-inputmask'=>'\'mask\': \'(999) 999-9999\'','data-mask'=>'')) !!}
                    <span class="help-block">{{ $errors->first('phone', ':message') }}</span>
                </div>
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

            <div class="form-group  {{ $errors->has('detail') ? 'has-error' : '' }}">
                {!! Form::label('detail', 'Опис', array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::textarea('detail', null, array('class' => 'form-control','rows'=>3)) !!}
                    <span class="help-block">{{ $errors->first('detail', ':message') }}</span>
                </div>
            </div>

            <div class="form-group  {{ $errors->has('status_id') ? 'has-error' : '' }}">
                {!! Form::label('status_id', 'Статус кліента', array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::select('status_id', $statuses->lists('name', 'id'), 1,array('class' => 'form-control')) !!}
                    <span class="help-block">{{ $errors->first('status_id', ':message') }}</span>
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
                    <div id="webcam"></div>
                    {!! Form::text('photo', null, array('class' => 'form-control','style'=>'display:none')) !!}
                    <span class="help-block">{{ $errors->first('photo', ':message') }}</span>
                    <a href="javascript:webcam.capture();void(0);" class="btn btn-sm btn-default">Зробити фото</a>
                    <div id="photo"></div>

                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <button type="reset" class="btn btn-sm btn-default">
                    <span class="glyphicon glyphicon-remove-circle"></span> Очистити
                </button>
                <button type="submit" class="btn btn-sm btn-success">
                    <span class="glyphicon glyphicon-ok-circle"></span> Створити
                </button>
            </div>
        </div>
    </div>


</div>

    {!! Form::close() !!}
@endsection
{{-- Scripts --}}
@section('custom-scripts')
    <script src="{{ asset ("/bower_components/AdminLTE/plugins/input-mask/jquery.inputmask.js") }}"></script>
    <script src="{{ asset ("/bower_components/AdminLTE/plugins/input-mask/jquery.inputmask.phone.extensions.js") }}"></script>
    <script src="{{ asset ("/bower_components/AdminLTE/plugins/input-mask/jquery.inputmask.extensions.js") }}"></script>
    <script src="{{ asset ("/bower_components/AdminLTE/plugins/JQuery/jquery.webcam.js") }}"></script>

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
                        $.post("/photoPut", {type: "data", image: canvas.toDataURL("image/png") });
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

                width: 320,
                height: 240,
                mode: "callback",
                swffile: "{{ asset ("/bower_components/AdminLTE/plugins/JQuery/jscam_canvas_only.swf") }}",

                onSave: saveCB,

                onCapture: function () {
                    webcam.save();
                },

                debug: function (type, string) {
                    console.log(type + ": " + string);
                }
            });

        });
    </script>
@stop