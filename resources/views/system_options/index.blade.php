@extends('layouts.app')
@section('custom-style')
    <link rel="stylesheet" href="{{ asset ("/bower_components/AdminLTE/plugins/iCheck/all.css") }}">
@stop
{{-- Content --}}
@section('content')
    {!! Form::open(array('url' => '/options/save', 'method' => 'post', 'files' => true)) !!}
            @foreach($optionsGroupArray as $optionArray)
                <div class="row bottom-menu-header">
                @foreach($optionArray as $option)
                @if (isset($option->tag))
                    <div class="col-md-{{$option->columns}}">
                        @include('system_options.inputs.'.$option->tag)
                    </div>
                @endif
            @endforeach
                </div>
        @endforeach
        <input type="submit">
        <p></p>
    {!! Form::close() !!}
@stop
{{-- Scripts --}}
@section('custom-scripts')
    <script src="{{ asset ("/bower_components/AdminLTE/plugins/iCheck/icheck.js") }}" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            $('.checkbox-options').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_flat'
            });
        });
    </script>
@stop
