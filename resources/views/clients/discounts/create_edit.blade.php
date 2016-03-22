@extends('layouts.app')
{{-- Content --}}
@section('content')
    <div class="bottom-menu-header">
        <h3>
            Нова знижка
            <div class="pull-right">
                <div class="pull-right">

                </div>
            </div>
        </h3>
    </div>
    @if (isset($discount))
    {!! Form::model($discount, array('url' => URL::to('discounts') . '/' . $discount->id.'/edit', 'method' => 'PUT', 'class' => 'bf', 'files'=> true)) !!}
    @else
    {!! Form::open(array('url' => URL::to('discounts'), 'method' => 'UPDATE', 'class' => 'bf', 'files'=> true)) !!}
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
            <div class="form-group  {{ $errors->has('detail') ? 'has-error' : '' }}">
                {!! Form::label('detail', 'Деталі', array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::text('detail', null, array('class' => 'form-control')) !!}
                    <span class="help-block">{{ $errors->first('detail', ':message') }}</span>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('percent') ? 'has-error' : '' }}">
                {!! Form::label('percent', 'Відсотки', array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::number('percent', null, array('class' => 'form-control')) !!}
                    <span class="help-block">{{ $errors->first('percent', ':message') }}</span>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('status') ? 'has-error' : '' }}">
                {!! Form::label('status', 'Статус', array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::text('status', null, array('class' => 'form-control')) !!}
                    <span class="help-block">{{ $errors->first('status', ':message') }}</span>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('enabled') ? 'has-error' : '' }}">
                {!! Form::label('enabled', 'Активний?', array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::label('enabled', 'Активний', array('class' => 'control-label')) !!}
                    {!! Form::radio('enabled', '1', @isset($discounts)? $discounts->enabled : '1') !!}
                    {!! Form::label('enabled', 'Деактивний', array('class' => 'control-label')) !!}
                    {!! Form::radio('enabled', '0', @isset($discounts)? $discounts->enabled : '0') !!}
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
                    @if	(isset($discount))
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
