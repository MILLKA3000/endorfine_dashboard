<div>

    <div class="col-md-3">

        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-body box-profile">
                <img class="img-responsive" style="width: 100%" src="http://milkapr/photo/1.png" alt="Фото клієнта">

                <h3 class="profile-username text-center">{{$numAbonement->getNameClient->name}}</h3>

                <p class="text-muted text-center">Кліент</p>

                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>№ Абонемента</b> <a class="pull-right">{{$numAbonement->numTicket}}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Знижка</b> <a class="pull-right"><small class="label label-success">(0%)</small></a>
                    </li>
                    <li class="list-group-item">
                        <b>День народження</b> <a class="pull-right">2016-03-29</a>
                    </li>
                    <li class="list-group-item">
                        <b>Загальна кількість занять</b> <a class="pull-right">543</a>
                    </li>
                    <li class="list-group-item">
                        <b>Заняття</b>
                    </li>
                    {{--<a href="#" class="btn btn-primary btn-block" id="checkTraning"><b>Відмітити</b></a>--}}
                </ul>

            </div>
            <!-- /.box-body -->
        </div>

        <!-- /.box -->
    </div>
</div>
