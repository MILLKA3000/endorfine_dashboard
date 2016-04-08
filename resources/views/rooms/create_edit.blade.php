@extends('layouts.app')
{{-- Content --}}
@section('content')
    <div class="bottom-menu-header">
        <h3>
            Зал
            <div class="pull-right">
                <div class="pull-right">

                </div>
            </div>
        </h3>
    </div>
@if (isset($room))
{!! Form::model($room, array('url' => URL::to('rooms') . '/' . $room->id, 'method' => 'PUT', 'class' => 'bf', 'files'=> true)) !!}
@else
{!! Form::open(array('url' => URL::to('rooms'), 'method' => 'UPDATE', 'class' => 'bf', 'files'=> true)) !!}
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
        <div class="form-group  {{ $errors->has('chapter_id') ? 'has-error' : '' }}">
            {!! Form::label('chapter_id', 'Філія', array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::select('chapter_id', $chapters->lists('name', 'id'), (isset($room))?$room->hapter_id:'',array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('chapter_id', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('info') ? 'has-error' : '' }}">
            {!! Form::label('info', 'Інформація', array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('info', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('info', ':message') }}</span>
            </div>
        </div>
        {!! Form::label('', 'Список тренерів для залу', array('class' => 'control-label h4 text-danger')) !!}
        <div class="row form-group">
            <div class="col-md-5">
                <br/>
                <span class="h5 nv-line">Список доступних тренерів</span>
                <br/>
                <br/>
                <div class="form-group">
                    <div class="col-md-12 ">
                        {!! Form::select('trainerAll[]',$getAllTrainer->lists('name', 'id'), '', array('multiple' => true, 'class'=>'form-control all-trainer', 'style'=>'height: 257px!important;')) !!}
                    </div>
                </div>

            </div>

            <!-- Block Add, Remove Allowed discipline-->
            <div class="col-md-2 text-center" style="position: relative; top:150px; font-size: 150%">
                <div class="row">
                    <i class="btn btn-default discipline-add"><span class="glyphicon glyphicon-forward"></span></i>
                </div>
                <div class="row">
                    <i class="btn btn-default discipline-remove"><span class="glyphicon glyphicon-backward"></span></i>
                </div>
            </div>

            <div class="col-md-5">
                <br/>
                <span class="h5 nv-line">Призначенні тренери</span>
                <br/>
                <br/>
                <div class="form-group">
                    <div class="col-md-12 ">
                        {!! Form::select('trainerAllowed[]',$trainerAllowed->lists('name', 'id'), '', array('multiple' => 'multiple', 'class'=>'form-control allowed-trainer', 'style'=>'height:275px;')) !!}
                    </div>
                </div>

            </div>

        </div>
        <br/>
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
@section('custom-scripts')
    <script type="text/javascript">
        $('.discipline-add').on('click',function(){
            if ($('.all-trainer option:selected').val() != null) {
                var tempSelect = $('.all-trainer option:selected').val();
                $('.all-trainer option:selected').remove().appendTo('.allowed-trainer');
                $(".all-countries").attr('selectedIndex', '-1').find("option:selected").removeAttr("selected");
                $(".allowed-trainer").attr('selectedIndex', '-1').find("option:selected").removeAttr("selected");
                $(".allowed-trainer").val(tempSelect);
                tempSelect = '';
                _sort_multi_select('.allowed-trainer');
            } else {
                alert("Before add please select any position.");
            }
        })

        /*
         action for removing countries from block 'allowed countries'
         */
        $('.discipline-remove').on('click',function(){
            if ($('.allowed-trainer option:selected').val() != null) {
                var tempSelect = $('.allowed-trainer option:selected').val();
                $('.allowed-trainer option:selected').remove().appendTo('.all-trainer');
                $(".all-trainer").attr('selectedIndex', '-1').find("option:selected").removeAttr("selected");
                $(".all-trainer").attr('selectedIndex', '-1').find("option:selected").removeAttr("selected");
                $(".all-trainer").val(tempSelect);
                tempSelect = '';
                _sort_multi_select('.all-trainer');
            } else {
                alert("Before add please select any position.");
            }
        })

        /*
         function for sorting array in select
         */
        function _sort_multi_select(selector){
            var sel = $(selector);
            var opts_list = sel.find('option');
            opts_list.sort(function(a, b) { return $(a).text() > $(b).text(); });
            sel.html('').append(opts_list);
        }

        /*
         pre sorting select (not use, if array receive sorted)
         */
        _sort_multi_select('.allowed-trainer');
        _sort_multi_select('.all-trainer');

        $('.bf').submit(function(even) {
            even.preventDefault();
            $(".allowed-trainer option:not(:selected)").prop("selected", true);
            this.submit();
        });

    </script>
@stop