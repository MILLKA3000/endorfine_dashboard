@extends('layouts.app')
{{-- Content --}}
@section('content')
    <div class="bottom-menu-header">
        <h3>
            Новий абонемент
            <div class="pull-right">
                <div class="pull-right">

                </div>
            </div>
        </h3>
    </div>
    @if (isset($ticket))
    {!! Form::model($ticket, array('url' => URL::to('tickets') . '/' . $ticket->id.'/edit', 'method' => 'PUT', 'class' => 'bf', 'files'=> true)) !!}
    @else
    {!! Form::open(array('url' => URL::to('tickets'), 'method' => 'UPDATE', 'class' => 'bf', 'files'=> true)) !!}
    @endif
            <!-- Tabs Content -->
    <div class="tab-content">
        <!-- General tab -->
        <div class="tab-pane active" id="tab-general">
            <div class="form-group  {{ $errors->has('name') ? 'has-error' : '' }}">
                {!! Form::label('name', 'Назва знижки', array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::text('name', null, array('class' => 'form-control')) !!}
                    <span class="help-block">{{ $errors->first('name', ':message') }}</span>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('qtySessions') ? 'has-error' : '' }}">
                {!! Form::label('qtySessions', 'Кількість заннять', array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::text('qtySessions', null, array('class' => 'form-control')) !!}
                    <span class="help-block">{{ $errors->first('qtySessions', ':message') }}</span>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('activityTime') ? 'has-error' : '' }}">
                {!! Form::label('activityTime', 'Період активності', array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::number('activityTime', null, array('class' => 'form-control')) !!}
                    <span class="help-block">{{ $errors->first('activityTime', ':message') }}</span>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('value') ? 'has-error' : '' }}">
                {!! Form::label('value', 'Ціна', array('class' => 'control-label')) !!}
                <div class="controls">

                    {!! Form::number('value', null, array('class' => 'form-control')) !!}
                    <span class="help-block">{{ $errors->first('value', ':message') }}</span>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('enabled') ? 'has-error' : '' }}">
                {!! Form::label('enabled', 'Активний?', array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::label('enabled', 'Активний', array('class' => 'control-label')) !!}
                    {!! Form::radio('enabled', '1', @isset($tickets)? $tickets->enabled : '1') !!}
                    {!! Form::label('enabled', 'Деактивний', array('class' => 'control-label')) !!}
                    {!! Form::radio('enabled', '0', @isset($tickets)? $tickets->enabled : '0') !!}
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
                    @if	(isset($ticket))
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
