@extends('layouts.app')

{{-- Content --}}
@section('content')
    <div class="bottom-menu-header">
        <h3>
            Сьогодні день народження у наступних людей
        </h3>
    </div>

    <table id="table2" class="table responsive no-wrap table-bordered table-hover dataTable"
        {{--data-global-search="true"--}}
        {{--data-paging="true"--}}
        {{--data-info="true"--}}
        {{--data-length-change="true"--}}
        {{--data-ajax="/clients/data"--}}
        data-page-length="25"
        width="100%">
        <thead>
        <tr>
            <th>#</th>
            <th>Фото</th>
            <th>Кліент</th>
            <th>Телефон</th>
            {{--<th>Перейти</th>--}}
            {{--<th>Знижка</th>--}}
            {{--<th>Заняття</th>--}}
            {{--<th>Активний</th>--}}
            {{--<th>Дія</th>--}}
        </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)
                    <tr style="height: 55px" onclick="$:location.href='{{ URL::to('clients/' . $client->id ) }}'">
                        <td>
                            {{$client->getNumTicket->numTicket}}
                        </td>
                        <td>
                            <img class="photo_mic" src="{{$client->photo}}" width="50">
                        </td>
                        <td>
                            {{$client->name}}
                        </td>
                        <td>
                            {{$client->phone}}
                        </td>
                    </tr>
            @endforeach
        </tbody>
    </table>
@stop

{{-- Scripts --}}
@section('custom-scripts')
    {{--<script src="{{ asset('js/dataTablesSelect.js') }}"></script>--}}
    <script>
        $('#table2').dataTable({responsive: true});
            {{--"fnInfoCallback": function(){--}}
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
            {{--}});--}}


    </script>
@stop
