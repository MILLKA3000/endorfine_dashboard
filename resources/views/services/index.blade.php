@extends('layouts.app')

{{-- Content --}}
@section('content')
    <div class="bottom-menu-header">
        <h3>
            Додаткові послуги
            <div class="pull-right">
                <div class="pull-right">
                    <a href="/services/create"
                       class="btn btn-sm  btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> Нова послуга</a>
                </div>
            </div>
        </h3>
    </div>

    <table id="table2" class="table table-bordered table-hover dataTable"
           data-global-search="true"
           data-paging="true"
           data-info="true"
           data-length-change="true"
           data-ajax="/services/data"
           data-page-length="25">
        <thead>
        <tr>
            <th data-sortable="true" data-filterable="text">Назва сервісу</th>
            <th data-sortable="true" data-filterable="text">Деталі</th>
            <th data-sortable="true" data-filterable="select">Акивний час</th>
            <th data-sortable="true" data-filterable="text">Ціна</th>
            <th data-sortable="true" >Активність</th>
            <th >Дія</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>

@stop

{{-- Scripts --}}
@section('custom-scripts')
    <script src="{{ asset('js/dataTablesSelect.js') }}"></script>
    <script>
        $('#table2').dataTableHelper();
    </script>
@stop
