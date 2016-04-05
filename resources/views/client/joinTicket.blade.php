@extends('layouts.app')
{{-- Content --}}
@section('content')


        <div class="row">
            @include('client.clientInfo')
            <!-- /.col -->
            <div class="col-md-9">

                @include('client.joinTicketSingle')

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
@endsection
{{-- Scripts --}}
@section('custom-scripts')

@stop