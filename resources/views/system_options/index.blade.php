@extends('layouts.app')
@section('custom-style')
    <link rel="stylesheet" href="{{ asset ("/bower_components/AdminLTE/plugins/iCheck/all.css") }}">
@stop
{{-- Content --}}
@section('content')

    @foreach($options as $option)
        @include('system_options.inputs.'.$option->tag)
    @endforeach

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
