@extends('layouts.app')

{{-- Content --}}
@section('content')

        <div class="bottom-menu-header">
            <h3>
                База Клієнтів
                <div class="pull-right">
                    <div class="pull-right">
                        <a class="btn btn-sm btn-warning" href="{{ URL::previous() }}">Назад</a>
                        <a href="/clients/create"
                           class="btn btn-sm  btn-primary"><span class="glyphicon glyphicon-plus-sign"></span>Новий Кліент</a>
                    </div>
                </div>
            </h3>
        </div>
        <table id="table2" class="table responsive no-wrap table-bordered table-hover dataTable"
               data-global-search="true"
               data-paging="true"
               data-info="true"
               data-length-change="true"
               data-ajax="/clients/data"
               data-page-length="25"
                width="100%">
            <thead>
            <tr>
                <th data-sortable="true" data-filterable="text">#</th>
                <th>Фото</th>
                <th data-sortable="true" data-filterable="text">Кліент</th>
                <th data-sortable="true" data-filterable="text">Телефон</th>
                <th data-sortable="true">Абонементи</th>
                <th data-sortable="true">Знижка</th>
                <th data-sortable="true" data-filterable="select">Заняття</th>
                <th data-sortable="true">Активний</th>
                <th>Дія</th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
@stop

{{-- Scripts --}}
@section('custom-scripts')
    <script src="{{ asset('js/dataTablesSelect.js') }}"></script>
    <script>
        $('#table2').dataTableHelper({responsive: true,
            "fnInfoCallback": function(){
                photo = $('.photo_mic');
                photo.on("mousedown", function(e){
                    width = $(this).innerWidth();
                    $(this).css({"position": "absolute","z-index": "1000"}).animate({
                        width: "300px"
                    }, 200);
                });

                photo.on("mouseup mouseout", function(e){
                    $(this).animate({
                        width: 50
                    }, 200,function(){
                        $(this).css({"z-index": "1"});
                    });
                });
            }});


    </script>
@stop
