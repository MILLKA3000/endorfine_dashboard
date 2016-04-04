<div class="overflow:hidden responsive">

    <div class="col-md-4 responsive overflow:hidden">

        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-body box-profile">
                <img class="img-responsive" style="width: 100%" src="{{$numAbonement->getNameClient->photo}}" alt="Фото клієнта">

                <h3 class="profile-username text-center">{{$numAbonement->getNameClient->name}}</h3>

                <p class="text-muted text-center">{{$numAbonement->getNameClient->getNameStatus->name}}</p>

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
                <b>Знижка</b> <a class="pull-right"><small class="label label-success">({{$numAbonement->getNameClient->getNameStatus->getNameDiscountForClients->percent}}%)</small></a>
            </li>
            <li class="list-group-item">
                <b>День народження</b> <a class="pull-right">{{$numAbonement->getNameClient->birthday}}</a>
            </li>
            <li class="list-group-item">
                <b>Загальна кількість занять</b> <a class="pull-right">0</a>
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
