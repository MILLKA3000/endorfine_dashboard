@extends('layouts.app')

{{-- Content --}}
@section('content')
    <div class="bottom-menu-header">
        <h3>
            Список Тренерів
            <div class="pull-right">
                <div class="pull-right">
                    <a href="/trainers/create"
                       class="btn btn-sm  btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> Новий Тренер</a>
                </div>
            </div>
        </h3>
    </div>

    <table id="table2" class="table table-bordered table-hover dataTable"
           data-global-search="true"
           data-paging="true"
           data-info="true"
           data-length-change="true"
           data-ajax="/trainers/getAllTrainers"
           data-page-length="25">
        <thead>
        <tr>
            <th data-sortable="true" data-filterable="text"> Ім'я </th>
            <th data-sortable="true" data-filterable="text"> Email </th>
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
