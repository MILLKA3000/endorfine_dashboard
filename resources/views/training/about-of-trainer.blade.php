@extends('layouts.app')
@section('custom-style')
    <link rel="stylesheet" href="{{ asset ("/bower_components/AdminLTE/plugins/fullcalendar/fullcalendar.min.css") }}"/>
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/qtip2/2.2.1/jquery.qtip.min.css"/>
@endsection

{{-- Content --}}
@section('content')
    <div id="calendar"></div>
@stop

{{-- Scripts --}}
@section('custom-scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="{{ asset ("/bower_components/AdminLTE/plugins/fullcalendar/fullcalendar.min.js") }}"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/qtip2/2.2.1/jquery.qtip.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                firstDay: 1,
                timeFormat: 'H:mm',
                editable: true,
                'fixedWeekCount':false,
                header: {
                    left: 'promptResource today prev,next',
                    center: 'title',
                    right: 'agendaWeek,month'
                },
                titleFormat: 'Тренер: {!!$trainer->name!!}',
                events: {!!$trainer->events!!},
                eventRender: function (event, element) {
                    element.find('.fc-title').html( event.title + '<span class="pull-right"> Клієнтів: ' + event.clients.length + '</span>' );
                    element.qtip({
                        content: {
                            title: {text: event.title},
                            text: 'Кількість клієнтів : ' + event.clients.length + '</b>'
                        },
                        position: {
                            my: 'top center',  // Position my top left...
                            at: 'bottom center', // at the bottom right of...
                        }
                        });
                },
                eventClick: function(event) {
                    // opens events in a popup window
                    window.location.replace('/training/detail/'+event.id);
                    return false;
                },

                loading: function(bool) {
                    $('#loading').toggle(bool);
                }
                });

        });


    </script>
@stop
