<div class="overflow:hidden responsive">
    <div class="col-md-12 responsive">

    </div>
    <div class="col-md-3 responsive">

        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-body box-profile">
                <div style="position: relative; left: 0; top: 0;">
                    <img class="img-responsive img-thumbnail" style="width: 100%" src="{{ URL::to($numAbonement->client->photo)}}" alt="Фото клієнта">
                    @if( stristr($numAbonement->client->birthday,date('m-d')) )
                        <img class="img-responsive" style="position: absolute; top: -20px; left: -20px; width: 40%" src="/img/birthday-surp.png">
                    @endif
                </div>
                <div class="bg-green color-palette"><span><h3 class="text-center">№: {{$numAbonement->numTicket}}</h3></span></div>
                <p class="text-center"><a href="/client/{{$numAbonement->client->id}}">{{$numAbonement->client->name}}</a></p>
                <p class="text-center">{{$numAbonement->client->getNameStatus->name}}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 responsive">
        <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
                <b>Телефон</b> <a class="pull-right">{{$numAbonement->client->phone}}</a>
            </li>
            <li class="list-group-item">
                <b>Знижка</b> <a class="pull-right"><small class="label label-success">({{$numAbonement->client->getNameStatus->getNameDiscountForClients->percent}}%)</small></a>
            </li>
            <li class="list-group-item">
                <b>День народження</b> <a class="pull-right">{{$numAbonement->client->birthday}}</a>
            </li>
            <li class="list-group-item">
                <b>Загальна кількість занять</b> <a class="pull-right" id="countAllTicketAccess">{{$numAbonement->event->countAllTicketAccess()}}</a>
            </li>

            @if(!empty($numAbonement->client->getActiveTickets->first()))
                <li class="list-group-item">
                    <b>Заняття</b> {!! Form::select('ticket',
                    array_pluck($numAbonement->training['traningFormated'],'title', 'id'), $numAbonement->training['activeTraning'] ,array('class' => 'form-control', 'id' => 'event-traning')) !!}</a>
                </li>
                <a href="#" class="btn btn-primary btn-block" id="checkTraning"><b>Відмітити</b></a>
            @endif
        </ul>

    </div>
    <div class="col-md-5 responsive">
        <a href="#" data-toggle="modal" style="margin-bottom: 5px" data-target="#Modal" data-remote="false" class="pull-right btn btn-primary">Добавити абонемент</a>
        <table id="ticket-table" class="table responsive no-wrap table-bordered table-hover dataTable"
               data-global-search="false"
               data-paging="true"
               data-info="false"
               data-length-change="false"
               data-ajax="/clients/getAllTickets/{{$numAbonement->client->id}}/active"
               data-page-length="4" >
            <thead>
            <tr>
                <th data-sortable="true">Активні абонементи</th>
                <th data-sortable="true">Статус</th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
            <!-- /.box-body -->


        <!-- /.box -->

</div>
<script>

    $(function() {
        $('.table').dataTable({responsive: true,bFilter: false,"sDom": '<"top"i>rt<"bottom"flp><"clear">'});
        $('#checkTraning').on('click',function(){
            if(send = checkEvent("{{ csrf_token() }}",{{$numAbonement->client->id}},$('#event-traning').val())){
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
                });

            };
        });


        $("#Modal").on("show.bs.modal", function(e) {
            self = $(this).find(".modal-body").html('');
            $(this).find("#myModalLabel").html('Добавити користувачу абонемент');
            $.ajax({
                method: "get",
                url: "/clients/{{$numAbonement->client->id}}/joinTicket",
                success: function(page){
                    console.log(page);
                    self.html(page);
                    $('.btn-success').on('click',function(e){
                        e.preventDefault();
                        $.ajax({
                            method: "PUT",
                            url: "/clients/{{$numAbonement->client->id}}/saveTicketClient",
                            data: $('form').serialize()
                        }).done(function(){
                            $("#Modal").modal('hide');
                            $('#search').val({{$numAbonement->numTicket}}).keyup();
                        });
                    })
                }
            })

        });

    });
</script>
