@extends('layouts.app')
{{-- Content --}}
@section('content')
    <div class="bottom-menu-header">
        <h3>
            Філія
            <div class="pull-right">
                <div class="pull-right">

                </div>
            </div>
        </h3>
    </div>
@if (isset($chapter))
{!! Form::model($chapter, array('url' => URL::to('chapters') . '/' . $chapter->id, 'method' => 'PUT', 'class' => 'bf', 'files'=> true)) !!}
@else
{!! Form::open(array('url' => URL::to('chapters'), 'method' => 'UPDATE', 'class' => 'bf', 'files'=> true)) !!}
@endif
        <!-- Tabs Content -->
<div class="tab-content row">
    <!-- General tab -->
    <div class="col-xs-12 tab-pane active" id="tab-general">
        <div class="form-group  {{ $errors->has('name') ? 'has-error' : '' }}">
            {!! Form::label('name', 'Назва філії', array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('name', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('address') ? 'has-error' : '' }}">
            {!! Form::label('address', 'Адреса', array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('address', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('address', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('email') ? 'has-error' : '' }}">
            {!! Form::label('email', 'E-mail філії', array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('email', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('email', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('info') ? 'has-error' : '' }}">
            {!! Form::label('info', 'Інформація', array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('info', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('info', ':message') }}</span>
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
                @if	(isset($chapter))
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
