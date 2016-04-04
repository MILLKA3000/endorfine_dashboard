<div class="overflow:hidden responsive">

    <div class="col-md-3 responsive overflow:hidden">

        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-body box-profile">
                <div style="position: relative; left: 0; top: 0;">
                    <img class="img-responsive img-thumbnail" style="width: 100%" src="{{ URL::to($numAbonement->client->photo)}}" alt="Фото клієнта">
                    @if( stristr($numAbonement->client->birthday,date('m-d')) )
                        <img class="img-responsive" style="position: absolute; top: -20px; left: -20px; width: 40%" src="/img/birthday-surp.png">
                    @endif
                </div>
                <h3 class="profile-username text-center"><a href="/client/{{$numAbonement->client->id}}">{{$numAbonement->client->name}}</a></h3>

                <p class="text-muted text-center">{{$numAbonement->client->getNameStatus->name}}</p>

            </div>

            <!-- /.box-body -->
        </div>
    </div>
    <div class="col-md-4 responsive overflow:hidden">
        <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
                <b>№ Абонемента</b> <a class="pull-right">{{$numAbonement->numTicket}}</a>
            </li>
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
                <b>Загальна кількість занять</b> <a class="pull-right">{{$numAbonement->event->countAllTicketAccess()}}</a>
            </li>
            <li class="list-group-item">
                <b>Заняття</b>
            </li>
            {{--<a href="#" class="btn btn-primary btn-block" id="checkTraning"><b>Відмітити</b></a>--}}
        </ul>

    </div>

            <!-- /.box-body -->


        <!-- /.box -->

</div>
