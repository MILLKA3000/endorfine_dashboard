            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="img-responsive" style="width: 100%" src="{{ URL::to('/photo/'.$client->id.'.png') }}" alt="Фото клієнта">

                        <h3 class="profile-username text-center">{{$client->name}}</h3>

                        <p class="text-muted text-center">{{$client->getNameStatus->name}}</p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>№ Абонемента</b> <a class="pull-right">{{$client->getActiveTickets->first()->numTicket}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Знижка</b> <a class="pull-right"><small class="label label-success">({{$client->getNameStatus->getNameDiscountForClients->percent}}%)</small></a>
                            </li>
                            <li class="list-group-item">
                                <b>День народження</b> <a class="pull-right">{{$client->birthday}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Загальна кількість занять</b> <a class="pull-right">543</a>
                            </li>
                            <li class="list-group-item">
                                <b>Заняття</b> {!! Form::select('ticket',
                                array_pluck($traningFormated,'title', 'id'), $activeTraning ,array('class' => 'form-control')) !!}</a>
                            </li>
                            <a href="#" class="btn btn-primary btn-block"><b>Відмітити</b></a>
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
