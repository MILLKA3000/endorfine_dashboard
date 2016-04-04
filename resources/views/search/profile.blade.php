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

            <!-- /.box-body -->


        <!-- /.box -->

</div>
<script>
    $(function() {
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
    });
</script>
