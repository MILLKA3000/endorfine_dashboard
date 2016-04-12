@extends('layouts.app')
@section('content')
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> УВАГА!</h4>
        {{$msg}}
    </div>

@endsection


