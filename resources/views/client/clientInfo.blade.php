            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <div style="position: relative; left: 0; top: 0;">
                            <img class="img-responsive img-thumbnail" style="width: 100%" src="{{ URL::to($client->photo)}}" alt="Фото клієнта">
                            @if( stristr($client->birthday,date('m-d')) )
                                <img class="img-responsive" style="position: absolute; top: -20px; left: -20px; width: 40%" src="/img/birthday-surp.png">
                            @endif
                        </div>

                        <h3 class="profile-username text-center">{{$client->name}}</h3>

                        <p class="text-muted text-center">{{$client->getNameStatus->name}}</p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>№ Абонемента</b> <a class="pull-right">{{$client->getNumTicket->numTicket}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Телефон</b> <a class="pull-right">{{$client->phone}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Знижка</b> <a class="pull-right"><small class="label label-success">({{$client->getNameStatus->getNameDiscountForClients->percent}}%)</small></a>
                            </li>
                            <li class="list-group-item">
                                <b>День народження клієнта</b> <a class="pull-right">{{$client->birthday}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Загальна кількість занять</b> <a class="pull-right" id="countAllTicketAccess">{{$client->countAllTicketAccess}}</a>
                            </li>
                            @if(isset($client->hasActiveTikets))
                            <li class="list-group-item">
                                <b>Заняття</b> {!! Form::select('ticket',
                                array_pluck($client->traningFormated,'title_concat_room', 'id'), $client->activeTraning['id'] ,array('class' => 'form-control', 'id' => 'event-traning')) !!}</a>
                            </li>
                                <a href="#" class="btn btn-primary btn-block" id="checkTraning"><b>Відмітити</b></a>
                            @endif
                        </ul>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <!-- About Me Box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Детальніше</h3>
                    </div>
                    <!-- /.box-header -->
                        <div class="box-body">

                            <strong><i class="fa fa-file-text-o margin-r-5"></i> Користувач створений</strong>

                            <p class="pull-right">{{$client->created_at}}</p>
                        </div>
                        <div class="box-body">

                            @if (!empty($client->detail))

                                <strong><i class="fa fa-file-text-o margin-r-5"></i> Опис</strong>

                                <p>{{$client->detail}}</p>

                            @endif
                        </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
@section('custom-scripts-sub')
    <script>
        $(function() {
            $('#checkTraning').on('click',function(){
                send = checkEvent("{{ csrf_token() }}",{{$client->id}},$('#event-traning').val());
                send.done(function (data) {
                    var obj = jQuery.parseJSON(data);
                    if(obj.countAllTicketAccess !== undefined) {
                        $('#countAllTicketAccess').text(obj.countAllTicketAccess);
                    }
                    if(obj.status !== undefined){
                        toastr["success"](obj.status);
                    }else{
                        toastr["error"](obj.error);
                    }

                    var tables = $.fn.dataTable.fnTables(true);

                    $(tables).each(function () {
                        $(this).dataTable().fnClearTable();
                        $(this).dataTable().fnDestroy();
                    });

                    $(".table").dataTable();
                    $('#calendar').fullCalendar('removeEvents');
                    $('#calendar').fullCalendar( 'addEventSource', obj.calendar);
                    $('#calendar').fullCalendar('refetchEvents');
                });
            });
        });
    </script>
@endsection