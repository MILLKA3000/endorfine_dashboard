@extends('layouts.app')

@section('custom-style')
    <link rel="stylesheet" href="{{ asset ("/bower_components/AdminLTE/plugins/fullcalendar/fullcalendar.min.css") }}"/>
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/qtip2/2.2.1/jquery.qtip.min.css"/>
@endsection

{{-- Content --}}
@section('content')
    <div class="bottom-menu-header">
        <h3>
            Графік тренувань
            <div class="pull-right">
                <div class="pull-right">

                </div>
            </div>
        </h3>
    </div>
    <div id='calendar'></div>

@stop

{{-- Scripts --}}
@section('custom-scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="{{ asset ("/bower_components/AdminLTE/plugins/fullcalendar/fullcalendar.min.js") }}"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/qtip2/2.2.1/jquery.qtip.min.js"></script>
    <script>

        $(document).ready(function(){
            $('#calendar').fullCalendar({
                firstDay: 1,
                timeFormat: 'H:mm',
                'fixedWeekCount':false,
                displayEventEnd: true,
                header: {
                    left: 'promptResource today prev,next',
                    center: 'title',
                    right: 'agendaWeek,month'
                },
                events: {!!$events!!},
                eventRender: function (event, element) {
                    element.qtip({
                        content: {
                            title: { text: event.title },
                            text:  event.description+'<br><br> <b> ТРЕНЕР: '+event.trainer+'</b>'
                        },
                        style: {
                            width: 200,
                            padding: 5,
                            color: 'black',
                            border: {
                                width: 1,
                                radius: 3
                            },
                            tip: 'topLeft'
                        }
                    });
        }

        });
        });

    </script>
@stop
