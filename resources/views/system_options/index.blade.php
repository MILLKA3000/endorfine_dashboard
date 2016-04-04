@extends('layouts.app')
@section('custom-style')
    <link rel="stylesheet" href="{{ asset ("/bower_components/AdminLTE/plugins/iCheck/all.css") }}">
@stop
{{-- Content --}}
@section('content')
    {!! Form::open(array('url' => '/options/save', 'method' => 'post', 'files' => true)) !!}
        @foreach($options as $option)
            @if (isset($option->tag))
                @include('system_options.inputs.'.$option->tag)
            @endif
        @endforeach
        <input type="submit">
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
