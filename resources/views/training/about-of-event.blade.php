@extends('layouts.app')

{{-- Content --}}
@section('content')
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12 text-center h1">
                {!! Cache::get('logo_switcher') == 'on' ? '<div class="logoinclude"></div>' : Cache::get('title')!!}</b>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    Тренування:  {{$event->name}}
                </h2>
                <h2 class="page-header">
                    Дата та час проведення: [{{$event->start}} - {{$event->end}}]
                </h2>
                <h2 class="page-header">
                    Тренер: {{$event->getNameTrainer->name}}
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <div class="row invoice-info">
            <div class="col-sm-12 invoice-col">
                Опис тренування: {{$event->description}}
            </div>
        </div>
        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Фото</th>
                        <th>Клієнт</th>
                        <th>Телефон</th>
                    </tr>
                    </thead>
                    @foreach($event->getVisitedClients as $tikets)
                        <tr>
                            <td>
                                <img height="50" src="{{$tikets->getTicket->getNameClient->photo}}">
                            </td>
                            <td>
                                {{$tikets->getTicket->getNameClient->name}}
                            </td>
                            <td>
                                {{$tikets->getTicket->getNameClient->phone}}
                            </td>
                        </tr>
                    @endforeach
                    <tr style="border-top: 2px solid #000">
                        <td colspan="2">
                            Загалом:
                        </td>
                        <td >
                            {{count($event->getVisitedClients)}}
                        </td>
                    </tr>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>

            </div>
        </div>
    </section>

@stop

{{-- Scripts --}}
@section('custom-scripts')
    <script src="{{ asset('js/dataTablesSelect.js') }}"></script>
    <script>
        $('#table2').dataTableHelper();
    </script>
@stop
