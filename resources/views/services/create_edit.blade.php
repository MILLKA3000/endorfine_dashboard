@extends('layouts.app')
{{-- Content --}}
@section('content')
    <div class="bottom-menu-header">
        <h3>
            Нова послуга
            <div class="pull-right">
                <div class="pull-right">

                </div>
            </div>
        </h3>
    </div>
    @if (isset($services))
    {!! Form::model($services, array('url' => URL::to('services') . '/' . $services->id, 'method' => 'PUT', 'class' => 'bf', 'files'=> true)) !!}
    @else
    {!! Form::open(array('url' => URL::to('services'), 'method' => 'UPDATE', 'class' => 'bf', 'files'=> true)) !!}
    @endif
            <!-- Tabs Content -->
    <div class="tab-content">
        <!-- General tab -->
        <div class="tab-pane active" id="tab-general">
            <div class="form-group  {{ $errors->has('name') ? 'has-error' : '' }}">
                {!! Form::label('name', 'Назва сервісу', array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::text('name', null, array('class' => 'form-control')) !!}
                    <span class="help-block">{{ $errors->first('name', ':message') }}</span>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('email') ? 'has-error' : '' }}">
                {!! Form::label('detail', 'Деталі', array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::text('detail', null, array('class' => 'form-control')) !!}
                    <span class="help-block">{{ $errors->first('detail', ':message') }}</span>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('activityTime') ? 'has-error' : '' }}">
                {!! Form::label('activityTime', 'Активний час', array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::text('activityTime', null, array('class' => 'form-control')) !!}
                    <span class="help-block">{{ $errors->first('activityTime', ':message') }}</span>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('value') ? 'has-error' : '' }}">
                {!! Form::label('value', 'Ціна', array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::text('value', null, array('class' => 'form-control')) !!}
                    <span class="help-block">{{ $errors->first('value', ':message') }}</span>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('enabled') ? 'has-error' : '' }}">
                {!! Form::label('enabled', 'Активний?', array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::label('enabled', 'Активний', array('class' => 'control-label')) !!}
                    {!! Form::radio('enabled', '1', @isset($services)? $services->enabled : '1') !!}
                    {!! Form::label('enabled', 'Деактивний', array('class' => 'control-label')) !!}
                    {!! Form::radio('enabled', '0', @isset($services)? $services->enabled : '0') !!}
                    <span class="help-block">{{ $errors->first('enabled', ':message') }}</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <button type="reset" class="btn btn-sm btn-default">
                    <span class="glyphicon glyphicon-remove-circle"></span> Очистити
                </button>
                <button type="submit" class="btn btn-sm btn-success">
                    <span class="glyphicon glyphicon-ok-circle"></span>
                    @if	(isset($services))
                        Зберегти
                    @else
                        Створити
                    @endif
                </button>
            </div>
        </div>
        {!! Form::close() !!}
        @stop
    </div>
