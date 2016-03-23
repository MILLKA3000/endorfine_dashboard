@extends('layouts.app')
{{-- Content --}}
@section('content')
    <div class="bottom-menu-header">
        <h3>
            Юзер
            <div class="pull-right">
                <div class="pull-right">

                </div>
            </div>
        </h3>
    </div>
@if (isset($user))
{!! Form::model($user, array('url' => URL::to('users') . '/' . $user->id, 'method' => 'PUT', 'class' => 'bf', 'files'=> true)) !!}
@else
{!! Form::open(array('url' => URL::to('users'), 'method' => 'UPDATE', 'class' => 'bf', 'files'=> true)) !!}
@endif
        <!-- Tabs Content -->
<div class="tab-content">
    <!-- General tab -->
    <div class="tab-pane active" id="tab-general">
        <div class="form-group  {{ $errors->has('name') ? 'has-error' : '' }}">
            {!! Form::label('name', 'Ім\'я', array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('name', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('email') ? 'has-error' : '' }}">
            {!! Form::label('email', 'Email', array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('email', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('email', ':message') }}</span>
            </div>
        </div>

        <div class="form-group  {{ $errors->has('role_id') ? 'has-error' : '' }}">
            {!! Form::label('role_id', 'Роль', array('class' => 'control-label')) !!}
            <div class="controls">
                    {!! Form::select('role_id', $roles->lists('name', 'id'), (isset($user))?$user->getNameRole->id:'',array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('role_id', ':message') }}</span>
            </div>
        </div>

        <div class="form-group  {{ $errors->has('password') ? 'has-error' : '' }}">
            {!! Form::label('password', 'Пароль', array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::password('password', array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('password', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
            {!! Form::label('password_confirmation', 'Пароль повторіть', array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::password('password_confirmation', array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('password_confirmation', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('enabled') ? 'has-error' : '' }}">
            {!! Form::label('enabled', 'Активний?', array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::label('enabled', 'Активний', array('class' => 'control-label')) !!}
                {!! Form::radio('enabled', '1', @isset($user)? $user->enabled : 'false') !!}
                {!! Form::label('enabled', 'Деактивний', array('class' => 'control-label')) !!}
                {!! Form::radio('enabled', '0', @isset($user)? $user->enabled : 'true') !!}
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
                @if	(isset($user))
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
