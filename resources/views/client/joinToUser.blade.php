@extends('layouts.app')
{{-- Content --}}
@section('content')


        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="img-responsive" style="width: 100%" src="{{ URL::to('/photo/'.$client->id.'.png') }}" alt="Фото клієнта">

                        <h3 class="profile-username text-center">{{$client->name}}</h3>

                        <p class="text-muted text-center">{{$client->getNameStatus->name}}</p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Абонемент</b> <a class="pull-right">{{$client->getActiveTickets->first()->numTicket}}</a>
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
            <!-- /.col -->
            <div class="col-md-9">

                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <div class="bottom-menu-header">
                                <h3>
                                    Добавити користувачу абонемент
                                    <div class="pull-right">
                                        <div class="pull-right">
                                        </div>
                                    </div>
                                </h3>
                            </div>
                            @if (isset($activeTicket))
                                {!! Form::model($activeTicket, array('url' => URL::to('/clients') . '/' .$client->id. '/' . $activeTicket->id.'/updateTicketClient', 'method' => 'UPDATE', 'class' => 'bf', 'files'=> true)) !!}
                            @else
                                {!! Form::open(array('url' => URL::to('/clients') . '/' . $client->id .'/saveTicketClient', 'method' => 'PUT', 'class' => 'bf', 'files'=> true)) !!}
                                @endif<!-- Tabs Content -->
                            <div class="tab-content">
                                <!-- General tab -->
                                <div class="tab-pane active" id="tab-general">
                                    <div class="col-md-12">

                                        <div class="form-group col-xs-8 {{ $errors->has('ticket') ? 'has-error' : '' }}">
                                            {!! Form::label('ticket', 'Абонемент', array('class' => 'control-label')) !!}
                                            <div class="controls">
                                                {!! Form::select('ticket', $tickets->lists('name', 'id'), 1,array('class' => 'form-control')) !!}
                                                <span class="help-block">{{ $errors->first('ticket', ':message') }}</span>
                                            </div>
                                        </div>

                                        <div class="form-group col-xs-8 {{ $errors->has('discount') ? 'has-error' : '' }}">
                                            {!! Form::label('discount', 'Знижка', array('class' => 'control-label')) !!}
                                            <div class="controls">
                                                {!! Form::select('discount', $discounts->lists('name', 'id'), 1,array('class' => 'form-control')) !!}
                                                <span class="help-block">{{ $errors->first('discount', ':message') }}</span>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <button type="reset" class="btn btn-sm btn-default">
                                                <span class="glyphicon glyphicon-remove-circle"></span> Очистити
                                            </button>
                                            <button type="submit" class="btn btn-sm btn-success">
                                                <span class="glyphicon glyphicon-ok-circle"></span> Добавити
                                            </button>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            {!! Form::close() !!}
                        </div>
                        <!-- /.tab-pane -->
                    </div>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
@endsection
{{-- Scripts --}}
@section('custom-scripts')

@stop