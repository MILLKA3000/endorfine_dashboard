@extends('layouts.app')
{{-- Content --}}
@section('content')
    <div class="bottom-menu-header">
        <h3>
            Статус кліента
            <div class="pull-right">
                <div class="pull-right">

                </div>
            </div>
        </h3>
    </div>
@if (isset($status))
{!! Form::model($status, array('url' => URL::to('/clients/statuses') . '/' . $status->id .'/edit', 'method' => 'PUT', 'class' => 'bf', 'files'=> true)) !!}
@else
{!! Form::open(array('url' => URL::to('/clients/statuses'), 'method' => 'UPDATE', 'class' => 'bf', 'files'=> true)) !!}
@endif
        <!-- Tabs Content -->
<div class="tab-content row">
    <!-- General tab -->
    <div class="col-xs-12 tab-pane active" id="tab-general">
        <div class="form-group  {{ $errors->has('name') ? 'has-error' : '' }}">
            {!! Form::label('name', 'Назва статуса', array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('name', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
            </div>
        </div>

        <div class="form-group  {{ $errors->has('discount_id') ? 'has-error' : '' }}">
            {!! Form::label('discount_id', 'Знижка', array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::select('discount_id', $discount->lists('name', 'id'), (isset($status))? $status->getNameDiscountForClients->id:'',array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('discount_id', ':message') }}</span>
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
                @if	(isset($status))
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
